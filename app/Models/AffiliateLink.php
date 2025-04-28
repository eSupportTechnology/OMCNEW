<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'raffle_ticket_id',
        'link',
    ];

    // Relationship to the User model
    public function user()
    {
        return $this->belongsTo(Aff_Customer::class);
    }

    // Relationship to the RaffleTicket model
    public function raffleTicket()
    {
        return $this->belongsTo(RaffleTicket::class, 'raffle_ticket_id');
    }

    // Define the relationship with the AffiliateProduct model
    public function affiliateProducts()
    {
        return $this->hasMany(AffiliateProduct::class);
    }

    public function product()
    {
        return $this->hasOneThrough(Products::class, AffiliateProduct::class, 'affiliate_link_id', 'id', 'id', 'product_id');
    }

}
                                        
