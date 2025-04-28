<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'withdraw_amount',
        'processing_fee',
        'paid_amount',
        'bank_name',
        'branch',
        'account_name',
        'account_number',
        'status',
        'requested_at',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
    ];
    
    public function affiliateUser()
    {
        return $this->belongsTo(Affiliate_User::class, 'user_id');
    }
}
