<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $related = Product::where('category_id', $product->category_id)
                          ->where('id', '!=', $product->id)
                          ->limit(4)
                          ->get();

        return view('product.show', compact('product', 'related'));
    }
}