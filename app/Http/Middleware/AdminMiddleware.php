<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/osis/login/mu')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        if (!Auth::user()->isAdmin()) {
            abort(404);
        }
        
        return $next($request);
    }
}