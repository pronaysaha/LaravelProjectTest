<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DateFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            // Check if the request has a 'date' parameter
            if ($request->has('date')) {
                $date = $request->input('date');

                // Filter posts based on the date and user ID
                $user->posts()->whereDate('created_at', $date);
            }
        }
        return $next($request);
    }
}
