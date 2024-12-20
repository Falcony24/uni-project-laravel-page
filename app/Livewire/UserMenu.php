<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserMenu extends Component{
    public bool $isAdmin = false;
    public bool $isUser = false;

    public function mount(){
        $this->isAdmin = Auth::check() && Auth::user()->isAdmin();
        $this->isUser = Auth::check();
    }
    public function logout(){
        return redirect()->route('logout');
    }

    public function render(){
        return view('livewire.shop.user-menu');
    }
}
