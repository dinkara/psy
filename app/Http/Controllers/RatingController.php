<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Repositories\Rating\IRatingRepo;
use App\Repositories\Session\ISessionRepo;
use App\Transformers\RatingTransformer;
use Tymon\JWTAuth\Facades\JWTAuth;
use Dinkara\DinkoApi\Http\Controllers\ResourceController;
use Storage;
use ApiResponse;
use App\Http\Requests\RatingAttachQuestionRequest;
use App\Repositories\Question\IQuestionRepo;
use App\Transformers\QuestionTransformer;
use App\Support\Enum\RatingOwners;

/**
 * @resource Rating
 */
class RatingController extends ResourceController
{

    /**
     * @var IQuestionRepo 
     */
    private $questionRepo;
        
    /**
     * @var ISessionRepo 
     */
    private $sessionRepo;
    
    public function __construct(IRatingRepo $repo, RatingTransformer $transformer, IQuestionRepo $questionRepo, ISessionRepo $sessionRepo) {
        parent::__construct($repo, $transformer);
	
        $this->middleware(['exists.session:session_id,true' , 'session.participant:session_id,true', 'session.completed:session_id,true', 'rating.added:session_id,true'], ['only' => ['store']]);

        $this->middleware(['exists.question:question_id,true', 'exists.rating', 'attach.question' ], ['only' => ['attachQuestion', 'detachQuestion']]);

    	$this->questionRepo = $questionRepo;
        
        $this->sessionRepo = $sessionRepo;

    }
    
    /**
     * Create item
     * 
     * Store a newly created item in storage.
     *
     * @param  App\Http\Requests\StoreRatingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRatingRequest $request)
    {       
        $data = $request->only($this->repo->getModel()->getFillable());

        $user = JWTAuth::parseToken()->toUser();
        $session = $this->sessionRepo->find($request->session_id)->getModel();
        $data["owner"] = $user->id == $session->doctor->user->id ? RatingOwners::DOCTOR : RatingOwners::PATIENT;
	
        return $this->storeItem($data);
    }

    /**
     * Update item 
     * 
     * Update the specified item in storage.
     *
     * @param  App\Http\Requests\UpdateRatingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRatingRequest $request, $id)
    {
        $data = $request->only($this->repo->getModel()->getFillable());        
        $item = $this->repo->find($id);

	
        return $this->updateItem($data, $id);
    }

        /**
     * Remove item
     * 
     * Remove the specified item from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            if($item = $this->repo->find($id)){
                
                $item->delete($id);
                return ApiResponse::ItemDeleted($this->repo->getModel());
            }
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        } 
        
        return ApiResponse::ItemNotFound($this->repo->getModel());       
    }
    
    /**
     * Get all Question for Rating with given $id
     *
     * Questions from existing resource.
     *
     * @param Request $request
     * @param  int  $id
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function allQuestions(Request $request, $id)
    {	   
        try{
            return ApiResponse::Collection($this->repo->find($id)->getModel()->questions($request->q, $request->orderBy)->get(), new QuestionTransformer);
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
    }

    /**
     * Paginated Question for Rating with given $id 
     * 
     * Display a list of paginated items .
     *
     * @param Request $request
     * @param  int  $id
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function paginatedQuestions(Request $request, $id)
    {   
        try{    
            if($pagination = $request->pagination){
                return ApiResponse::Pagination($this->repo->find($id)->getModel()->questions($request->q, $request->orderBy)->paginate($pagination), new QuestionTransformer); 
            }
            else{
                return ApiResponse::Pagination($this->repo->find($id)->getModel()->questions($request->q, $request->orderBy)->paginate(), new QuestionTransformer); 
            }   
            
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        } 
    }

    /**
     * Attach Question
     *
     * Attach the Question to existing resource.
     *
     * @param  App\Http\Requests\RatingAttachQuestionRequest  $request
     * @param  int  $id
     * @param  int  $question_id
     * @return \Illuminate\Http\Response
     */
    public function attachQuestion(RatingAttachQuestionRequest $request, $id, $question_id)
    {
            $data = $request->only(array_keys($request->rules()));
	    	
	    $model = $this->questionRepo->find($question_id)->getModel();

            return ApiResponse::ItemAttached($this->repo->find($id)->attachQuestion($model, $data)->refreshAvgRate()->getModel(), $this->transformer);
    }

    
    /**
     * Detach Question
     *
     * Detach the Question from existing resource.
     *
     * @param  App\Http\Requests\RatingAttachQuestionRequest  $request
     * @param  int  $id
     * @param  int  $question_id
     * @return \Illuminate\Http\Response
     */
    public function detachQuestion($id, $question_id)
    {	    	
	$model = $this->questionRepo->find($question_id)->getModel();
        return ApiResponse::ItemDetached($this->repo->find($id)->detachQuestion($model)->getModel());
    }

}