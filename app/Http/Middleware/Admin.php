<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Hakikisha user yupo na ni admin
        if (auth::user()->usertype !== 'admin') {
            return redirect('/');
        }

        return $next($request);
    }
}