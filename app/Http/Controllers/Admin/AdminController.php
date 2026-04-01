<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalProducts  = Product::count();
        $totalUsers     = User::count();
        $activeProducts = Product::where('is_active', true)->count();

        return view('admin.index', compact(
            'totalProducts',
            'totalUsers',
            'activeProducts'
        ));
    }
}