<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class CatalogController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();

        $query = Product::with('category')->where('is_active', true);

        if (request('category')) {
            $query->whereHas('category', function($q) {
                $q->where('slug', request('category'));
            });
        }

        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        $products = $query->paginate(6)->withQueryString();

        return view('catalog.index', compact('categories', 'products'));
    }

    public function sales()
    {
        $categories = Category::withCount('products')->get();
        $products = Product::with('category')
                           ->where('is_active', true)
                           ->where('discount', '>', 0)
                           ->paginate(6);

        return view('catalog.sales', compact('categories', 'products'));
    }
}