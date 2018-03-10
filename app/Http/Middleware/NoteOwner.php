<?php

namespace App\Http\Middleware;

use App\Repositories\Note\INoteRepo;
use Closure;
use Dinkara\DinkoApi\Http\Middleware\DinkoApiOwnerMiddleware;
use Lang;
use ApiResponse;
use JWTAuth;

class NoteOwner extends DinkoApiOwnerMiddleware
{

    /**
     * Create a new Session Middleware instance.
     *
     * @return void
     */
    public function __construct(INoteRepo $repo) {
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

        if($resource->doctor->user && $user && $resource->doctor->user->id != $user->id){
            return ApiResponse::Unauthorized(Lang::get("dinkoapi.middleware.owner_failed"));
        }

        return $next($request);
    }
}
