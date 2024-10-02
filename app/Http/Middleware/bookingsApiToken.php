<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class bookingsApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //nos creamos nuestra propia llave (API-KEY)
        if(!$request->header('FSJ22-KEY')){
            return response()->json(['error' => 'The required header is missing'], 400);
        }

        $request->header('FSJ22-KEY', 'HJrwm1hU5SSCG4YGQcTSvGPVxUiecVRzYYCejm');
        return $next($request);
    }
}
