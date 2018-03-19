<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Repositories\Session\ISessionRepo;
use App\Transformers\SessionTransformer;
use Tymon\JWTAuth\Facades\JWTAuth;
use Dinkara\DinkoApi\Http\Controllers\ResourceController;
use Storage;
use ApiResponse;
use App\Transformers\NoteTransformer;
use App\Transformers\RatingTransformer;
use App\Support\Enum\SessionStatuses;

/**
 * @resource Session
 */
class SessionController extends ResourceController
{

    
    
    public function __construct(ISessionRepo $repo, SessionTransformer $transformer) {
        parent::__construct($repo, $transformer);
	
        $this->middleware('exists.doctor:doctor_id,true', ['only' => ['store']]);

        $this->middleware('exists.patient:patient_id,true', ['only' => ['store']]);

        $this->middleware('doctor', ['only' => ['store', 'update', 'cancel', 'destroy']]);

        $this->middleware('owns.session', ['only' => ['update', 'cancel', 'destroy']]);
    }
    
    /**
     * Create item
     * 
     * Store a newly created item in storage.
     *
     * @param  App\Http\Requests\StoreSessionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSessionRequest $request)
    {       
        $data = $request->only($this->repo->getModel()->getFillable());
        $user = JWTAuth::parseToken()->toUser();
        $data['doctor_id'] = $user->doctor->id;
	
        return $this->storeItem($data);
    }
    
    /**
     * Update item 
     * 
     * Update the specified item in storage.
     *
     * @param  App\Http\Requests\UpdateSessionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSessionRequest $request, $id)
    {
        $data = $request->only($this->repo->getModel()->getFillable());        
        $item = $this->repo->find($id);

	
        return $this->updateItem($data, $id);
    }

    /**
     * Cancel item 
     * 
     * Sets session status to canceled
     *     
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {                	
        try {
            if( $item = $this->repo->find($id)){
                return ApiResponse::ItemUpdated($item->cancel()->getModel(), new $this->transformer, class_basename($this->repo->getModel()));
            }
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
        return ApiResponse::ItemNotFound($this->repo->getModel());
                                
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
     * Get all Note for Session with given $id
     *
     * Notes from existing resource.
     *
     * @param Request $request
     * @param  int  $id
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function allNotes(Request $request, $id)
    {	   
        try{
            return ApiResponse::Collection($this->repo->find($id)->getModel()->notes($request->q, $request->orderBy)->get(), new NoteTransformer);
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
    }

    /**
     * Paginated Note for Session with given $id 
     * 
     * Display a list of paginated items .
     *
     * @param Request $request
     * @param  int  $id
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function paginatedNotes(Request $request, $id)
    {   
        try{    
            if($pagination = $request->pagination){
                return ApiResponse::Pagination($this->repo->find($id)->getModel()->notes($request->q, $request->orderBy)->paginate($pagination), new NoteTransformer); 
            }
            else{
                return ApiResponse::Pagination($this->repo->find($id)->getModel()->notes($request->q, $request->orderBy)->paginate(), new NoteTransformer); 
            }   
            
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        } 
    }
    /**
     * Get all Rating for Session with given $id
     *
     * Ratings from existing resource.
     *
     * @param Request $request
     * @param  int  $id
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function allRatings(Request $request, $id)
    {	   
        try{
            return ApiResponse::Collection($this->repo->find($id)->getModel()->ratings($request->q, $request->orderBy)->get(), new RatingTransformer);
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
    }

    /**
     * Paginated Rating for Session with given $id 
     * 
     * Display a list of paginated items .
     *
     * @param Request $request
     * @param  int  $id
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function paginatedRatings(Request $request, $id)
    {   
        try{    
            if($pagination = $request->pagination){
                return ApiResponse::Pagination($this->repo->find($id)->getModel()->ratings($request->q, $request->orderBy)->paginate($pagination), new RatingTransformer); 
            }
            else{
                return ApiResponse::Pagination($this->repo->find($id)->getModel()->ratings($request->q, $request->orderBy)->paginate(), new RatingTransformer); 
            }   
            
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        } 
    }



}