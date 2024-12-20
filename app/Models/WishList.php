<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model{
    public $timestamps = false;
    protected $table = 'wishlists';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
