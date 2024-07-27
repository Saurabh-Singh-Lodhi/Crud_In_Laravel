<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products/create',[ProductController::class,'create'])->name('products.create');

Route::get('/products',[ProductController::class,'index'])->name('products.index');

Route::post('/products',[ProductController::class,'store'])->name('products.store');

Route::get('/products/{productId}/edit',[ProductController::class,'edit'])->name('products.edit');

Route::put('/products/{productId}',[ProductController::class,'update'])->name('products.update');

Route::delete('/products/{productId}',[ProductController::class,'delete'])->name('products.delete');

