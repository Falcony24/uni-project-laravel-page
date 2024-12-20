<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;

    public $timestamps = false;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'price',
        'description',
        'stock',
        'sub_category_id',
        'brand_id'
    ];

    protected $attributes = [
        'stock' => 0
    ];

    protected static function newFactory(): ProductFactory {
        return ProductFactory::new();
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function subCategory(){
        return $this->belongsTo(SubCategory::class);
    }
    public function productImages() {
        return $this->hasMany(ProductImage::class);
    }
    public function firstImage(){
        return $this->hasOne(ProductImage::class)->oldestOfMany();
    }
    public function cart(){
        return $this->hasMany(Cart::class, 'product_id', 'id');
    }
    public function wishList(){
        return $this->hasMany(WishList::class, 'product_id', 'id');
    }

}
