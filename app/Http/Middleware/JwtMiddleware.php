<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Traits\ApiResponser;

class JwtMiddleware
{
    use ApiResponser;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
          } catch (Exception $e) {
              if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                  // return response()->json(['status' => 'Token is Invalid']);
                  return $this->errorResponse([],  'Token is Invalid', 401);
              }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                  // return response()->json(['status' => 'Token is Expired']);
                  return $this->errorResponse([],  'Token is Expired', 401);

              }else{
                  // return response()->json(['status' => 'Authorization Token not found']);
                  return $this->errorResponse([],  'Token is Expired', 401);
              }
          }
          return $next($request);
    }
}
