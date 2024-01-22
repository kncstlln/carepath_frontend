<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserType
{
    public function handle($request, Closure $next, ...$allowedTypes)
    {
        // Exclude the /login route from the middleware
        if ($request->is('login')) {
            return $next($request);
        }

        $currentUserType = session('user_type');

        if (is_null($currentUserType)) {
            return redirect('/login');
        }

        // Redirect based on user_type
        if ($currentUserType === 0 && !in_array(0, $allowedTypes)) {
            return redirect()->route('admin.dashboard');
        } elseif ($currentUserType === 1 && !in_array(1, $allowedTypes)) {
            return redirect()->route('user.dashboard');
        }

        return $next($request);
    }
}
