<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialOffers extends Model
{
    use HasFactory;
    protected $table = 'special_offers';

    protected $fillable = [
        'product_id',
        'normal_price',
        'offer_rate',
        'offer_price',
        'month',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'product_id');
    }
}
