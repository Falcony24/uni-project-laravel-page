<?php

namespace App\Livewire;

use App\Models\Addresses;
use Livewire\Component;

class UserAddresses extends Component{
    public $addresses = [];

    public $name;
    public $surname;
    public $city;
    public $street;
    public $number;


    public function mount(){
        $this->addresses = Addresses::where('user_id', auth()->id())->get();
    }

    public function render(){
        return view('livewire.user.user-addresses');
    }
}
