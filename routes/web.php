<?php

use App\Http\Controllers\ProductsController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
//    return Product::paginate();
//    return Product::all();
});

Route::prefix('api')->group(function () {
    Route::resource('products', ProductsController::class);
});
