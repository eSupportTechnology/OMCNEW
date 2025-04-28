<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliate_Customer extends Model
{
    use HasFactory;

    // Specify the table name (optional, if it's not automatically detected)

    protected $table = 'aff_customers';


    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'address',
        'district',
        'DOB',
        'gender',
        'NIC',
        'contactno',
        'email',
        'password',              // This will be hashed
        'promotion_method',       // This will be handled as JSON
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

    // The attributes that should be cast to native types
    protected $casts = [
        'promotion_method' => 'array',  // Casting the JSON field
        'DOB' => 'date',                // Casting the date of birth as a date
    ];

    /**
     * If you need to hash passwords automatically.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);  // Automatically hashes the password
    }
}
