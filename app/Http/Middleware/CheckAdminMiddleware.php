<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminMiddleware{
    public function handle(Request $request, Closure $next) {
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Brak dostępu do tej strony.');
        }

        if (Auth::check() && Auth::user()->isUser() && request()->is('admin*')) {
            return redirect('/')->with('error', 'Użytkownicy nie mają dostępu do profilu.');
        }

        return $next($request);
    }
}
