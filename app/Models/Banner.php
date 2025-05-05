<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'image_path',
        'position', // e.g., 'left', 'right', 'bottom'
        'is_active',
    ];
}
