<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPass
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() && $request->user()->role_id != 1) { // on vérifie si l'utilisateur n'est pas connecté et si il possède autre chose que le role_id 1 (Admin)
            return redirect('/'); // si c'est la cas, on le redirige vers "/" qui est notre page d’accueil
        }

        return $next($request); // si l'utilisateur ne fait pas partie du cas au-dessus, alors on le laisse passer 
    }
}
