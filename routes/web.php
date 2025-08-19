<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php
use App\Http\Controllers\{HomeController, ProductController, CategoryController};

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/producto/{slug}', [ProductController::class, 'show'])->name('product.show');

// Ruta jerárquica de categorías: /c/tenis/running
Route::get('/c/{path}', [CategoryController::class, 'show'])
     ->where('path','.*')->name('category.show');

Route::get('/buscar', [ProductController::class, 'search'])->name('product.search');
