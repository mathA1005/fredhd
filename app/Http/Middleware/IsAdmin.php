<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;  // Ajout de la façade Auth

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // Rediriger l'utilisateur s'il n'est pas administrateur
            return redirect('/home')->with('error', 'Vous navez pas les droits nécessaires pour accéder à cette page');
        }

        return $next($request);
    }
}
