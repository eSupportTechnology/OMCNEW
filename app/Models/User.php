<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'profile_image',
        'district',
        'date_of_birth',
        'gender',
        'phone_num',
        'acc_no',
        'bank_name',
        'branch',
        'role',
        'status',
        'last_login',
        'google_id',
        'facebook_id',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function customerOrders()
    {
        return $this->hasMany(CustomerOrder::class, 'user_id', 'id');
    }

    //dashboard
    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/' . $this->profile_image);
        } else {
            $firstLetter = strtoupper(substr($this->name, 0, 1));
            return 'https://ui-avatars.com/api/?name=' . $firstLetter . '&size=100';
        }
    }


    public function addresses()
    {
        return $this->hasMany(Address::class);  // Adjust as per your actual relationship
    }
}
