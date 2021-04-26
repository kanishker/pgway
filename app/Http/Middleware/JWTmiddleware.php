<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $messege = '';
        try {
           JWTAuth::parseToken()->authenticate();
           return $next($request);

        }
         catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e)
        {
            $messege = 'Token Expired';
        }
        catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e)
        {
            $messege = 'Token Invalid';
        }
        catch (\Tymon\JWTAuth\Exceptions\TokenException $e)
        {
            $messege = 'Provde A token';
        }
        return response()->json([
            'success'=>false,
            'Messege'=>$messege
        ]);
    }
}
