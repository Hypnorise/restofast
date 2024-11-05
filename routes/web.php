<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TablesController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
//    return Product::paginate();
//    return Product::all();
});

Route::prefix('api')->group(function () {
    Route::resource('products', ProductsController::class);

	Route::get('categories/withProducts/{category?}',[CategoriesController::class,'withProducts']);
    Route::resource('categories', CategoriesController::class);

	Route::get('tables/toggleActive/{table}',[TablesController::class,'toggleActive']);
    Route::resource('tables', TablesController::class);

});
