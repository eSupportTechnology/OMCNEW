<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'reason',
        'status'
    ];

    public function order()
    {
        return $this->belongsTo(CustomerOrder::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
