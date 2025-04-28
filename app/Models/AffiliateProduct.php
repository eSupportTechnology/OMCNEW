<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateProduct extends Model
{
    use HasFactory;

    protected $table = 'affiliate_product';

    protected $fillable = [
        'product_id',
        'affiliate_link_id',
    ];

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    // Define the relationship with the AffiliateLink model
    public function affiliateLink()
    {
        return $this->belongsTo(AffiliateLink::class);
    }
}
