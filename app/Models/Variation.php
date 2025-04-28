<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'type',
        'value',
        'hex_value',
        'quantity'

    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'product_id');
    }

    public function images()
    {
        return $this->hasMany(VariationImage::class, 'variation_id', 'id');
    }
}
