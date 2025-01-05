<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model {
    use HasFactory;

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

    public static function rules() {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'phone_number' => 'required|string|max:15',
        ];
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}
