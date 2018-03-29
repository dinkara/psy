<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Repositories\Question\IQuestionRepo;
use App\Support\Enum\QuestionTypes;
use ApiResponse;
use Lang;

class AttachQuestion
{

    protected $repo;

    /**
     * Create a new Doctor Middleware instance.
     *
     * @return void
     */
    public function __construct(IQuestionRepo $repo) {
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
        $type = $this->repo->find($request->route('question_id'))->getModel()->type;
        
        if(($user->doctor && 
            ($type === QuestionTypes::DOCTOR || $type === QuestionTypes::BOTH)) || 
            ($user->patient && ($type === QuestionTypes::PATIENT || $type === QuestionTypes::BOTH))){
                return $next($request);
        }else{
            return ApiResponse::Unauthorized(Lang::get("middlewares.questions.insufficient_permissions"));
        };
    }
}
