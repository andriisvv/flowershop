<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;

Route::get('/', [CatalogController::class, 'index'])->name('catalog');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/cart', fn() => view('catalog.index'))->name('cart');
Route::get('/login', fn() => view('catalog.index'))->name('login');
Route::get('/register', fn() => view('catalog.index'))->name('register');