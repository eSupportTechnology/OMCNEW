<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAffiliate extends Model
{
    use HasFactory;

    protected $table = 'order_affiliates';

    protected $fillable = [
        'order_code',
        'tracking_id',
    ];

    /**
     * Relationship: OrderAffiliate belongs to a CustomerOrder
     */
    public function order()
    {
        return $this->belongsTo(CustomerOrder::class, 'order_code', 'order_code');
    }

    /**
     * Relationship: Optionally link to RaffleTicket via tracking_id
     */
    public function raffleTicket()
    {
        return $this->belongsTo(RaffleTicket::class, 'tracking_id', 'token');
    }
}
