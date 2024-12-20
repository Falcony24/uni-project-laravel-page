<?php

namespace App\Models;

use Database\Factories\BrandFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model {
    use HasFactory;

    public $timestamps = false;
    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];
    protected static function newFactory(): BrandFactory {
        return BrandFactory::new();
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
