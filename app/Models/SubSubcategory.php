<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubcategory extends Model
{
    protected $fillable = ['subcategory_id', 'sub_subcategory'];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
