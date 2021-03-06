<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use ApiResponse;
use Lang;

class IsPatient
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
        $user = JWTAuth::parseToken()->toUser();
        
        if($user->patient){            
            return $next($request);
        }else{            
            return ApiResponse::Unauthorized(Lang::get("auth.insufficient_permissions"));
        }
    }
}
