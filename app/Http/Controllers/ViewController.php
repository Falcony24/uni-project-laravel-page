<?php

namespace App\Http\Controllers;
// Controller dla widokow które nie potrzebują dodatkowej logiki
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller {
    public function defaultPage() {
        return view('shop.shopMain', ['title' => 'Strona główna']);
    }
    public function viewLogin() {
        return view('login.login', ['title' => 'Autoryzacja']);
    }
    public function adminView() {
        return view('admin', ['title' => 'Administracja']);
    }
    public function cartView() {
        return view('profile.cart', ['title' => 'Koszyk']);
    }
    public function profileView() {

        return view('profile.profileMain', [
            'title' => 'Profil',
        ]);
    }
}
