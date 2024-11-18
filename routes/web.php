<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('app');
//    return Product::paginate();
//    return Product::all();
});
Route::get('/uploadCSV',function (){
	return view('uploadCSV');
});

Route::prefix('api')->group(function () {
    Route::resource('products', ProductController::class);

	Route::get('categories/withproducts/{category?}',[CategoryController::class,'withProducts']);
    Route::resource('categories', CategoryController::class);

	Route::get('tables/withorders/{table?}', [TableController::class,'withOrders']);
	Route::get('tables/toggleActive/{table}',[TableController::class,'toggleActive']);
    Route::resource('tables', TableController::class);

	Route::get('orders/withproducts/{order?}', [OrderController::class,'withProducts']);
	Route::resource('orders', OrderController::class);
});

function respondJson($success=true,$text='',$code=200)
{
	$message['message'] = ['success'=>$success,'text'=>$text];
	return response()->json($message,$code);
}
function makeOrderRef()
{
	$d = now()->format('D');
	$d = Str::upper($d);
	$d = Str::limit($d,2,"");
	$d .= now()->format('ymdHis');
	return $d;
}
