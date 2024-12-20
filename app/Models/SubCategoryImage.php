<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategoryImage extends Model {
    public $timestamps = false;
    protected $table = 'sub_categories_images';
    protected $primaryKey = 'id';
    protected $fillable = [
        'file_name',
        'file_path',
        'sub_categories_id',
    ];

    public function subCategory(){
        return $this->belongsTo(SubCategory::class);
    }
}
