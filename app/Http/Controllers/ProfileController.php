<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Addresses;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller{
    public function addAddress(AddressRequest $request){
        Addresses::create([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'city' => $request['city'],
            'postal_code' => $request['postal_code'],
            'street' => $request['street'],
            'number' => $request['number'],
            'phone_number' => $request['phone_number'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Adres został zapisany!');
    }

    public function index(){
        return view('profile.profileMain', [
            'title' => 'Profil',
        ]);
    }
}
