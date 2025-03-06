<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooProduct extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $appends = ['final_price'];

    public function getFinalPriceAttribute()
    {
        return $this->attributes['base_price'] * (1 + $this->attributes['tax_rate'] * 0.01);
    }
}
