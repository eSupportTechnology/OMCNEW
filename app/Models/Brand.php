<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'image',
        'slug',
        'is_top_brand',
    ];

    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
