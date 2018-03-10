<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreWalletRequest;
use App\Http\Requests\UpdateWalletRequest;
use App\Repositories\Wallet\IWalletRepo;
use App\Transformers\WalletTransformer;
use Tymon\JWTAuth\Facades\JWTAuth;
use Dinkara\DinkoApi\Http\Controllers\ResourceController;
use Storage;
use ApiResponse;
use App\Transformers\TransactionTransformer;


/**
 * @resource Wallet
 */
class WalletController extends ResourceController
{

    
    
    public function __construct(IWalletRepo $repo, WalletTransformer $transformer) {
        parent::__construct($repo, $transformer);
	
        $this->middleware('owns.wallet', ['only' => ['update', 'destroy']]);

    
    
    }
    
    /**
     * Create item
     * 
     * Store a newly created item in storage.
     *
     * @param  App\Http\Requests\StoreWalletRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWalletRequest $request)
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
     * @param  App\Http\Requests\UpdateWalletRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWalletRequest $request, $id)
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
     * Get all Transaction for Wallet with given $id
     *
     * Transactions from existing resource.
     *
     * @param Request $request
     * @param  int  $id
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function allTransactions(Request $request, $id)
    {	   
        try{
            return ApiResponse::Collection($this->repo->find($id)->getModel()->transactions($request->q, $request->orderBy)->get(), new TransactionTransformer);
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
    }

    /**
     * Paginated Transaction for Wallet with given $id 
     * 
     * Display a list of paginated items .
     *
     * @param Request $request
     * @param  int  $id
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function paginatedTransactions(Request $request, $id)
    {   
        try{    
            if($pagination = $request->pagination){
                return ApiResponse::Pagination($this->repo->find($id)->getModel()->transactions($request->q, $request->orderBy)->paginate($pagination), new TransactionTransformer); 
            }
            else{
                return ApiResponse::Pagination($this->repo->find($id)->getModel()->transactions($request->q, $request->orderBy)->paginate(), new TransactionTransformer); 
            }   
            
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        } 
    }



}