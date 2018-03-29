<?php

namespace App\Http\Middleware;

use App\Repositories\Session\ISessionRepo;
use Closure;
use Dinkara\DinkoApi\Http\Middleware\DinkoApiOwnerMiddleware;
use Lang;
use ApiResponse;
use JWTAuth;
use App\Support\Enum\RatingOwners;

class RatingAlreadyAdded {

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
    public function handle($request, Closure $next, $key = 'session_id', $isForeign = false)
    {       
        $this->id = $request->id;

        if($isForeign){            
	    $this->id = $request->get("$key");
            
            if(!$this->id){
                $this->id = eval('return $request->'.$key.';');
            }
        }
        
        $this->repo->find($this->id);

        $resource = $this->repo->getModel();

        $user = JWTAuth::parseToken()->toUser();
        
        $found = false;
        foreach($resource->ratings as $rating){
            if(($rating->owner == RatingOwners::DOCTOR && $user->doctor) || ($rating->owner == RatingOwners::PATIENT && $user->patient)){
                $found = true;
                break;
            }
        }
        
        if($found){
            return ApiResponse::Unauthorized(Lang::get("middlewares.ratings.already_added"));
        }

        return $next($request);
    }
}
