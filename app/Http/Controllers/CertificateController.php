<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use App\Repositories\Certificate\ICertificateRepo;
use App\Transformers\CertificateTransformer;
use Tymon\JWTAuth\Facades\JWTAuth;
use Dinkara\DinkoApi\Http\Controllers\ResourceController;
use Storage;
use ApiResponse;


/**
 * @resource Certificate
 */
class CertificateController extends ResourceController
{

    
    
    public function __construct(ICertificateRepo $repo, CertificateTransformer $transformer) {
        parent::__construct($repo, $transformer);
	
        $this->middleware('exists.doctor:doctor_id,true', ['only' => ['store']]);


        $this->middleware('doctor', ['only' => ['store', 'update', 'destroy']]);

        $this->middleware('owns.certificate', ['only' => ['update', 'destroy']]);
    }
    
    /**
     * Create item
     * 
     * Store a newly created item in storage.
     *
     * @param  App\Http\Requests\StoreCertificateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCertificateRequest $request)
    {       
        $data = $request->only($this->repo->getModel()->getFillable());
        $user = JWTAuth::parseToken()->toUser();
        $data['doctor_id'] = $user->doctor->id;
        if($request->file("url")){
            $data["url"] = $request->file("url")->store(config("storage.certificates.url"));   
        }
    
	
        return $this->storeItem($data);
    }

    /**
     * Update item 
     * 
     * Update the specified item in storage.
     *
     * @param  App\Http\Requests\UpdateCertificateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCertificateRequest $request, $id)
    {
        $data = $request->only($this->repo->getModel()->getFillable());        
        $item = $this->repo->find($id);
        if($request->file("url")){
            Storage::delete($item->getModel()->url);
    
            $data["url"] = $request->file("url")->store(config("storage.certificates.url"));
        }
    
	
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
                Storage::delete($item->getModel()->url);
    
                $item->delete($id);
                return ApiResponse::ItemDeleted($this->repo->getModel());
            }
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        } 
        
        return ApiResponse::ItemNotFound($this->repo->getModel());       
    }
    



}