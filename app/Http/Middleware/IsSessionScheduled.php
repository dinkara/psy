<?php

namespace App\Http\Middleware;

use Closure;
use ApiResponse;
use Lang;
use App\Support\Enum\SessionStatuses;
use App\Repositories\Session\ISessionRepo;

class IsSessionScheduled
{
    protected $repo;
    protected $id;
    
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
    public function handle($request, Closure $next, $key = 'session_id', $isForeign = false)
    {        
        $this->id = $request->id;

        if($isForeign){            
	    $this->id = $request->get("$key");
            
            if(!$this->id){
                $this->id = eval('return $request->'.$key.';');
            }
        }
        
        if($this->repo->find($this->id)->getModel()->status == SessionStatuses::SCHEDULED){
            return $next($request);
        }else{
            return ApiResponse::Unauthorized(Lang::get("middlewares.sessions.notscheduled"));
        }

    }
}
