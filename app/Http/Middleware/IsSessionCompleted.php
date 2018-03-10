<?php

namespace App\Http\Middleware;

use Closure;
use ApiResponse;
use Lang;
use App\Support\Enum\SessionStatuses;
use App\Repositories\Session\ISessionRepo;

class IsSessionCompleted
{
    protected $repo;

    /**
     * @return mixed
     */
    public function __construct(ISessionRepo $repo)
    {
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
        if($this->repo->find($request->session_id)->getModel()->status == SessionStatuses::COMPLETED){
            return $next($request);
        }else{
            return ApiResponse::Unauthorized(Lang::get("middlewares.sessions.notcompleted"));
        }

    }
}
