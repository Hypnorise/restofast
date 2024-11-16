<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return Order::all();
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{

		if ($request->isNotFilled("products")) return respondJson(false, "No products", 400);
		if ($request->isNotFilled("table_id")) return respondJson(false, "No table", 400);

		DB::beginTransaction();

		try {
			$ref = makeOrderRef();
			$newOrder = new Order();
			$newOrder->table_id = $request->input('table_id');
			$newOrder->ref = $ref;
			if ($request->filled("comment")) $newOrder->comment = $request->input("comment");
			$newOrder->amount = 0;
			$newOrder->save();
			$newOrder->refresh();
			$products = $request->collect("products")->mapWithKeys(function (array $item, int $key) {
				return [$item['id'] => ['quantity'=> $item['quantity']]];
			});
			$newOrder->products()->attach($products);

			return "";
		} catch (\Exception $e) {
			DB::rollBack();
			return $e->getMessage();
		}
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Order $order)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Order $order)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Order $order)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Order $order)
	{
		//
	}

	public function withProducts(Order $order = null)
	{

		if ($order == null) {
			$orders = Order::with('products')->get();
			return $orders;
		}

		$order->load('products');

		$order->change = $order->given - $order->amount;
		return $order;
	}
}
