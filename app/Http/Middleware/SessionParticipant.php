<?php

namespace App\Http\Middleware;

use App\Repositories\Session\ISessionRepo;
use Closure;
use Dinkara\DinkoApi\Http\Middleware\DinkoApiOwnerMiddleware;
use Lang;
use ApiResponse;
use JWTAuth;
class SessionParticipant {

    protected $repo;

    /**
     * Create a new Session Middleware instance.
     *
     * @return void
     */
    public function __construct(ISessionRepo $repo) {
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
        $this->repo->find($request->id);

        $resource = $this->repo->getModel();

        $user = JWTAuth::parseToken()->toUser();
        
        if($resource->doctor->user && $resource->patient->user && $user && $resource->doctor->user->id != $user->id && $resource->patient->user->id != $user->id){
            return ApiResponse::Unauthorized(Lang::get("dinkoapi.middleware.owner_failed"));
        }

        return $next($request);
    }
}
