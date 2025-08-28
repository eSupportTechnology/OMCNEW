<?php

namespace App\Models;

use Illuminate\Container\Attributes\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_name',
        'product_description',
        'product_category',
        'brand_id',
        'subcategory',
        'sub_subcategory',
        'quantity',
        'tags',
        'normal_price',
        'is_affiliate',
        'affiliate_price',
        'commission_percentage',
        'total_price',
        'product_id',
    ];


    protected static function booted()
    {
        static::creating(function ($product) {
            $product->product_id = 'PRODUCT-' . strtoupper(Str::random(6));
        });
    }



    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'product_category', 'id');
    }


    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function subSubcategory()
    {
        return $this->belongsTo(SubSubcategory::class);
    }


    public function variations()
    {
        return $this->hasMany(Variation::class, 'product_id', 'product_id');
    }

    public function specialOffer()
    {
        return $this->hasOne(SpecialOffers::class, 'product_id', 'product_id')->where('status', 'active');
    }


    public function Sale()
    {
        return $this->hasOne(Sale::class, 'product_id', 'product_id')->where('status', 'active');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'product_id');
    }

    public function affiliateProducts()
    {
        return $this->hasMany(AffiliateProduct::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function shippingCharges()
    {
        return $this->hasMany(ShippingCharge::class, 'product_id', 'product_id');
    }
}
