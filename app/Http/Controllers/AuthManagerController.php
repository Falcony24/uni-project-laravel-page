<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthManagerController extends Controller {
    public function login(LoginRequest $request) {
        if(Auth::attempt($request->only(['email', 'password']))) {
            CartController::syncGuestCartToUser();

            return redirect()->intended('/profile');
        }

        return redirect(route('login.view'))->with('error', 'Dane logowania są nieprawidłowe');
    }
    public function logout() {
        Session::flash('success', 'Zostałeś pomyślnie wylogowany.');
        Auth::logout();
        return redirect('/');
    }

    public function register(RegisterRequest $request) {
        try {
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($user) {
                Auth::login($user);
                return redirect()->intended('/profile')->with('success', 'Rejestracja udana. Zalogowano.');
            }

            return redirect()->back()->with('error', 'Rejestracja nie powiodła się. Spróbuj ponownie.');
        } catch (Exception $e) {
            Log::error('Błąd podczas rejestracji użytkownika: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Wystąpił błąd. Spróbuj ponownie później.');
        }
    }
}
