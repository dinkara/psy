<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Requests\SearchSessionsRequest;
use App\Repositories\Patient\IPatientRepo;
use App\Transformers\PatientTransformer;
use Tymon\JWTAuth\Facades\JWTAuth;
use Dinkara\DinkoApi\Http\Controllers\ResourceController;
use Storage;
use ApiResponse;
use App\Transformers\SessionTransformer;


/**
 * @resource Patient
 */
class PatientController extends ResourceController
{

    
    
    public function __construct(IPatientRepo $repo, PatientTransformer $transformer) {
        parent::__construct($repo, $transformer);
	
        $this->middleware('owns.patient', ['only' => ['update', 'destroy']]);
        
        $this->middleware('patient', ['only' => ['store', 'update', 'destroy', 'allSessions', 'paginatedSessions', 'sessionsInRange']]);
    
    }
    
    /**
     * Create item
     * 
     * Store a newly created item in storage.
     *
     * @param  App\Http\Requests\StorePatientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePatientRequest $request)
    {       
        $data = $request->only($this->repo->getModel()->getFillable());

	    $data["user_id"] = JWTAuth::parseToken()->toUser()->id;   
    
        return $this->storeItem($data);
    }

    /**
     * Update item 
     * 
     * Update the specified item in storage.
     *
     * @param  App\Http\Requests\UpdatePatientRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePatientRequest $request, $id)
    {
        $data = $request->only($this->repo->getModel()->getFillable());        
        $item = $this->repo->find($id);

	    $data["user_id"] = JWTAuth::parseToken()->toUser()->id;   
    
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
     * Get all Session for Patient with given $id
     *
     * Sessions from existing resource.
     *
     * @param Request $request     
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function allSessions(Request $request)
    {	   
        try{
            $user = JWTAuth::parseToken()->toUser();
            return ApiResponse::Collection($this->repo->find($user->patient->id)->getModel()->sessions($request->q, $request->orderBy)->get(), new SessionTransformer);
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
    }

    /**
     * Paginated Session for Patient with given $id 
     * 
     * Display a list of paginated items .
     *
     * @param Request $request     
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function paginatedSessions(Request $request)
    {   
        try{    
            if($pagination = $request->pagination){
                $user = JWTAuth::parseToken()->toUser();
                return ApiResponse::Pagination($this->repo->find($user->patient->id)->getModel()->sessions($request->q, $request->orderBy)->paginate($pagination), new SessionTransformer); 
            }
            else{
                return ApiResponse::Pagination($this->repo->find($user->patient->id)->getModel()->sessions($request->q, $request->orderBy)->paginate(), new SessionTransformer); 
            }   
            
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        } 
    }


    /**
     * Get all Session for Doctor with given $id in timespan
     *
     * Sessions from existing resource.
     *
     * @param Request $request     
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function sessionsInRange(SearchSessionsRequest $request)
    {	   
        try{
            $user = JWTAuth::parseToken()->toUser();
            return ApiResponse::Collection($this->repo->find($user->patient->id)->sessionsInRange($request->start, $request->end), new SessionTransformer);
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
    }
    
}