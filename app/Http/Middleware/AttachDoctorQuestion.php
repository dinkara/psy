<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Repositories\Question\IQuestionRepo;
use App\Support\Enum\QuestionTypes;
use ApiResponse;
use Lang;

class AttachDoctorQuestion
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
        if($user->doctor && $this->repo->find($request->route('question_id'))->getModel()->type === QuestionTypes::PATIENT){
            return $next($request);
        }else{
            return ApiResponse::Unauthorized(Lang::get("middlewares.questions.insufficient_permissions"));
        };
    }
}
