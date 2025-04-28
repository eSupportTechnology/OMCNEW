<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateReferral extends Model
{
    use HasFactory;

    // Define the table associated with this model
    protected $table = 'affiliate_referrals';

    // Define which fields are mass assignable
    protected $fillable = [
        'user_id',
        'raffle_ticket_id',
        'product_url',
        'views_count',
        'referral_count',
        'completed_at',
        'product_price',
        'affiliate_commission',
        'total_affiliate_price',
    ];

    /**
     * Relationship with the User model (Affiliate).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with the RaffleTicket model.
     */
    public function raffleTicket()
    {
        return $this->belongsTo(RaffleTicket::class, 'raffle_ticket_id');
    }

    public function affiliateProduct()
    {
        return $this->hasOne(AffiliateProduct::class, 'affiliate_link_id', 'raffle_ticket_id'); // Assuming raffle_ticket_id maps to affiliate_link_id
    }

    



   

}
