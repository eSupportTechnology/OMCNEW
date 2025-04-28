<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['category_id', 'subcategory'];

    
    public function subSubcategories()
    {
        return $this->hasMany(SubSubcategory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
