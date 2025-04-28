<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateRule extends Model
{
    use HasFactory;


    protected $table = 'affiliate_rules';

    protected $fillable = [
        'rule',
    ];
}
