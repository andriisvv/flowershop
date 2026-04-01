<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart');
        }

        $products = [];
        $total = 0;

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $products[] = [
                    'product'  => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $product->price * $item['quantity'],
                ];
                $total += $product->price * $item['quantity'];
            }
        }

        return view('order.checkout', compact('products', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'email'   => 'required|email',
            'address' => 'required|string',
        ], [
            'name.required'    => "Ім'я обов'язкове",
            'phone.required'   => 'Телефон обов\'язковий',
            'email.required'   => 'Email обов\'язковий',
            'address.required' => 'Адреса обов\'язкова',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart');
        }

        $total = 0;
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $total += $product->price * $item['quantity'];
            }
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'name'    => $request->name,
            'phone'   => $request->phone,
            'email'   => $request->email,
            'address' => $request->address,
            'comment' => $request->comment,
            'total'   => $total,
            'status'  => 'pending',
        ]);

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'quantity'   => $item['quantity'],
                    'price'      => $product->price,
                ]);
            }
        }

        session()->forget('cart');

        return redirect()->route('order.success', $order->id);
    }

    public function success($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('order.success', compact('order'));
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->orderBy('created_at', 'desc')
                       ->get();
        return view('order.my-orders', compact('orders'));
    }
}