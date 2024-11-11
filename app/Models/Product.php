<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
	protected $fillable = ['name','price'];
	protected function price(): Attribute
	{
		return Attribute::make(
			get: fn (string $value) => (float) ($value),
		);
	}
//    protected $with = ['category'];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
