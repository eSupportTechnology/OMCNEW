<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaffleTicket extends Model
{
    use HasFactory;

    protected $table = 'raffle_tickets';

    // Fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'token',
        'status'
    ];

    // Define the possible statuses
    const STATUS_PENDING = 'Pending';
    const STATUS_ACTIVE = 'Active';
    const STATUS_USED = 'Used';
    const STATUS_EXPIRED = 'Expired';

    // Define the relationship to the User (or AffCustomer if that's what you're using)
    public function user()
    {
        return $this->belongsTo(AffiliateUser::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class); // Assuming a product is related to a raffle ticket
    }
}
