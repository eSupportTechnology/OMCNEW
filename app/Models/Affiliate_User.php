<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliate_User extends Model
{
    use HasFactory;
    
    protected $table = 'affiliate_users';

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

    protected $casts = [
        'promotion_method' => 'array',  
        'DOB' => 'date',                
    ];


    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);  
    }


    
}
