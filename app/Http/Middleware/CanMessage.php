<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\User\IUserRepo;
use Tymon\JWTAuth\Facades\JWTAuth;
use ApiResponse;
use Lang;

class CanMessage
{
    
        
    /**
     * Create a new User Middleware instance.
     *
     * @return void
     */
    public function __construct(IUserRepo $repo) {
        $this->repo = $repo;        
    }
    
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
        $receiver = $this->repo->find($request->receiver_id)->getModel();
        if($user->patient || in_array($user->id, $receiver->contacts->pluck('id')->toArray())){
            return $next($request);
        }else{
            return ApiResponse::Unauthorized(Lang::get("auth.insufficient_permissions"));
        }
    }
}
