<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return Table::all();
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
		return makeOrderRef();
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		//TODO Check if the table is active
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//TODO Check if the table is active
	}

	public function toggleActive(Table $table)
	{
		$table->free = !$table->free;
	}

	public function withOrders(Table $table = null)
	{
//		dd(Table::with('orders')->get());
		if ($table == null) {
			$tableWithOrders = Table::with([
				'orders' => function ($query) {
					$query->where('order_state_id', 1);
				},
					'orders.products'
				]
			)->get();
		}
//			foreach ($tableWithOrder as $table) {
//				echo "<hr>";
//				echo ($table->orders()->with('products')->get());
//				echo "<hr>";
//			}
//		dd($tableWithOrders);

		return $tableWithOrders;

	}
}
