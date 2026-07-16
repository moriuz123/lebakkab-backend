<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = config('app.api_key', env('APP_API_KEY'));
        $providedKey = $request->header('X-API-KEY');

        // Check if API Key is configured in .env and matches
        if ($apiKey && $providedKey !== $apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid or missing API Key.'
            ], 401);
        }

        return $next($request);
    }
}
