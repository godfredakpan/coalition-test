<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;


Route::get('/', [ProductsController::class, 'showForm'])->name('show-form');


Route::post('/save-product', [ProductsController::class, 'saveProduct'])->name('save-product');

Route::put('/update-product/{id}', [ProductsController::class, 'updateProduct'])->name('update-product');
