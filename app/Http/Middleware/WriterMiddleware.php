<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class WriterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check yang login penulis dan harus verified
        if ($request->user()->hasRole('writer') && !Auth::user()->is_verified) {
            return response()->view('backend.writers.unverified', ['owner_email' => 'feifeifry@gmail.com'], 403);
        }
        return $next($request);
    }
}