<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QA extends Model
{
    protected $fillable = [
        'product_id',
        'question',
        'answer',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
