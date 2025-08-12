<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    protected $fillable = ['product_id','min_quantity', 'max_quantity', 'charge'];

    public function product()
{
    return $this->belongsTo(Products::class, 'product_id', 'product_id');
}
}


