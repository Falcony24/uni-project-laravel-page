<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
    ];
    protected $hidden = [
        'password'
    ];
    protected $casts = [
        'email_confirmed' => 'boolean',
    ];
    public function isAdmin(): bool {
        return $this->role === 1 && auth()->check();
    }
    public function isUser(): bool {
        return $this->role === 0 && auth()->check();
    }

    public function addresses(){
        return $this->hasMany(Addresses::class);
    }
    public function cart(){
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }
    public function wishList(){
        return $this->hasMany(WishList::class, 'user_id', 'id');
    }
}
