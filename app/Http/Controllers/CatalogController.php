<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class CatalogController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $products = Product::with('category')
                           ->where('is_active', true)
                           ->paginate(6);

        return view('catalog.index', compact('categories', 'products'));
    }
}