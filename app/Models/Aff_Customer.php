<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aff_Customer extends Model
{
    use HasFactory;
    protected $table = 'aff_customers';

    protected $fillable = [
        'name',
        'address',
        'district',
        'DOB',
        'gender',
        'NIC',
        'contactno',
        'email',
        'password',
        'promotion_method',
        'instagram_url',
        'facebook_url',
        'tiktok_url',
        'youtube_url',
        'content_website_url',
        'content_whatsapp_url',
        'bank_name',
        'branch',
        'account_name',
        'account_number',
        'status',
    ];
}
