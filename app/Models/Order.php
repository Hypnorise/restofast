<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
	public $timestamps = false;

	protected function given(): Attribute
	{
		return Attribute::make(
			get: fn(string $value) => (float)($value),
		);
	}

	protected function amount(): Attribute
	{
		return Attribute::make(
			get: fn(string $value) => (float)($value),
		);
	}

	public function products(): BelongsToMany
	{
		return $this->belongsToMany(Product::class)->withPivot('quantity');
	}
}
