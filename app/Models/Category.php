<?php

namespace App\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];
    protected static function newFactory(): CategoryFactory {
        return CategoryFactory::new();
    }
    public function subCategories(){
        return $this->hasMany(SubCategory::class, 'category_id');
    }
}
