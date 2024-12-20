<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model {
    public $timestamps = false;
    protected $table = 'product_images';
    protected $primaryKey = 'id';
    protected $fillable = [
        'file_name',
        'file_path',
        'product_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
