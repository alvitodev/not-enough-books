<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (Auth::check() && Auth::user()->is_admin == 1) {
      return $next($request);
    }

    // If not an admin, redirect to home or show an unauthorized error
    // For now, let's redirect to the home page for non-admins.
    // You might want to return a 403 Forbidden response instead.
    // return response('Unauthorized.', 403);
    return redirect(route('home'))->with('error', 'You do not have admin access.');
  }
}