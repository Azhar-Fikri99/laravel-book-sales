<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Checkrole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // return $next($request);

        try{
            $user = JWTAuth::parseToken()->authenticate();

            // if(!in_array($user-> role !==  'admin')){
            if(!in_array($user-> role, $roles)){
                return response()->json([
                    'success' => false,
                    'message'=>"Unauthorized"
                ], 403);
            }

            return $next($request);
            
            // ini kalau token nya salah ketik, atau expired token 
        }catch(JWTException $e){
            return response()->json([
                'success' => false,
                'message'=>"Token is Invalid or Expired"
            ], 401);
        }
    }
}
