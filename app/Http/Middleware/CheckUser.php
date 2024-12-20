<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUser {
    public function handle(Request $request, Closure $next) {
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Brak dostępu do tej strony.');
        }

        if (Auth::check() && Auth::user()->isAdmin() && request()->is('profile*')) {
            return redirect('/')->with('error', 'Administratorzy nie mają dostępu do profilu.');
        }

        return $next($request);
    }
}
