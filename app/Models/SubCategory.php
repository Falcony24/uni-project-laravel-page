<?php

namespace App\Models;

use Database\Factories\SubCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model {
    use HasFactory;

    public $timestamps = false;
    protected $table = 'sub_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'category_id'
    ];
    protected static function newFactory(): SubCategoryFactory {
        return SubCategoryFactory::new();
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subCategoryImages() {
        return $this->hasMany(SubCategoryImage::class, 'sub_categories_id');
    }
}
