<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role = null): Response
    {
        if (Auth::check()) {
            $user = Auth::user();


            if ($user->role === 'admin') {
                    return $next($request);
            }
            if ($user->role === 'runner' && !$request->is('runsnap/logout*')) { 
                return redirect('/runner/dashboard');
            }
            if ($user->role === 'fotografer' && !$request->is('runsnap/logout*')) { 
                return redirect('/fotografer/dashboard');
            }
        }

        return $next($request);

    }
}
