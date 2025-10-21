<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory;


    protected $table = 'customer_order';

    protected $fillable = [
        'order_code',
        'user_id',
        'customer_fname',
        'phone',
        'email',
        'company_name',
        'address',
        'apartment',
        'city',
        'postal_code',
        'date',
        'total_cost',
        'status',
        'payment_method',
        'payment_status',
        'discount',
        'transaction_id',
        'delivery_fee',
        'tracking_id',
    ];


    public function items()
    {
        return $this->hasMany(CustomerOrderItems::class, 'order_code', 'order_code');
    }


    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
