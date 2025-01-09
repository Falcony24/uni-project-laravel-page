<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model {
    public $timestamps = false;
    protected $table = 'addresses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'surname',
        'city',
        'postal_code',
        'street',
        'number',
        'phone_number',
        'user_id'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
