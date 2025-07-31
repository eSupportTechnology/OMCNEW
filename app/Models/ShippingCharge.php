<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    protected $fillable = ['min_quantity', 'max_quantity', 'charge'];
}
