<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/admin/login');
        }

        if (Auth::user()->role !== 'admin') {
            Auth::logout();
            return redirect('/admin/login')->withErrors([
                'email' => 'Only admin users can access the admin panel.',
            ]);
        }

        return $next($request);
    }
}