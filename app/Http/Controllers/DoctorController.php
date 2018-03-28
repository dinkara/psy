<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Repositories\Doctor\IDoctorRepo;
use App\Transformers\DoctorTransformer;
use Tymon\JWTAuth\Facades\JWTAuth;
use Dinkara\DinkoApi\Http\Controllers\ResourceController;
use Storage;
use ApiResponse;
use App\Transformers\CertificateTransformer;
use App\Transformers\SessionTransformer;
use App\Http\Requests\SearchSessionsRequest;

/**
 * @resource Doctor
 */
class DoctorController extends ResourceController
{

    
    
    public function __construct(IDoctorRepo $repo, DoctorTransformer $transformer) {
        parent::__construct($repo, $transformer);
	
        $this->middleware('exists.company:company_id,true', ['only' => ['store']]);

        $this->middleware('owns.doctor', ['only' => ['update', 'destroy']]);

        $this->middleware('doctor', ['only' => ['store', 'update', 'destroy', 'sessionsInRange', 'allSessions', 'paginatedSessions', 'allCertificates', 'paginatedCertificates']]);
    
    }
    
    /**
     * Create item
     * 
     * Store a newly created item in storage.
     *
     * @param  App\Http\Requests\StoreDoctorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDoctorRequest $request)
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
     * @param  App\Http\Requests\UpdateDoctorRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoctorRequest $request, $id)
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
     * Get all Certificate for Doctor with given $id
     *
     * Certificates from existing resource.
     *
     * @param Request $request
     * @param  int  $id
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function allCertificates(Request $request, $id)
    {	   
        try{
            return ApiResponse::Collection($this->repo->find($id)->getModel()->certificates($request->q, $request->orderBy)->get(), new CertificateTransformer);
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
    }

    /**
     * Paginated Certificate for Doctor with given $id 
     * 
     * Display a list of paginated items .
     *
     * @param Request $request
     * @param  int  $id
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function paginatedCertificates(Request $request, $id)
    {   
        try{    
            if($pagination = $request->pagination){
                return ApiResponse::Pagination($this->repo->find($id)->getModel()->certificates($request->q, $request->orderBy)->paginate($pagination), new CertificateTransformer); 
            }
            else{
                return ApiResponse::Pagination($this->repo->find($id)->getModel()->certificates($request->q, $request->orderBy)->paginate(), new CertificateTransformer); 
            }   
            
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        } 
    }
    /**
     * Get all Session for Doctor with given $id
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
            return ApiResponse::Collection($this->repo->find($user->doctor->id)->getModel()->sessions($request->q, $request->orderBy)->get(), new SessionTransformer);
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
    }

    /**
     * Paginated Session for Doctor with given $id 
     * 
     * Display a list of paginated items .
     *
     * @param Request $request     
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function paginatedSessions(Request $request)
    {   
        try{    
            $user = JWTAuth::parseToken()->toUser();
            if($pagination = $request->pagination){
                return ApiResponse::Pagination($this->repo->find($user->doctor->id)->getModel()->sessions($request->q, $request->orderBy)->paginate($pagination), new SessionTransformer); 
            }
            else{
                return ApiResponse::Pagination($this->repo->find($user->doctor->id)->getModel()->sessions($request->q, $request->orderBy)->paginate(), new SessionTransformer); 
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
            return ApiResponse::Collection($this->repo->find($user->doctor->id)->sessionsInRange($request->start, $request->end), new SessionTransformer);
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
    }

    

}