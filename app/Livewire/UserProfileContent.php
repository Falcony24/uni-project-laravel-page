<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use

class UserProfileContent extends Component{
    public $user;
    public $opt;
    public $content = [];

    public function wishList(){

    }
    public function addresses(){

    }
    public function loadData($opt) {
        $this->opt = $opt;

        switch ($opt) {
            case 'wishList':
                $this->wishList();
                break;
            case 'addresses':
                $this->addresses();
                break;
        }
        if($this->opt != 'user') {
            // wrócić po dodaniu wish listy
        }
    }
    public function mount(){
        $this->opt = 'profile';
        $this->user = Auth::user();
    }
    public function render(){
        return view('livewire.user.user-profile-content');
    }
}
