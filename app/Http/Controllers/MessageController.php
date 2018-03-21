<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Repositories\Message\IMessageRepo;
use App\Transformers\MessageTransformer;
use Tymon\JWTAuth\Facades\JWTAuth;
use Dinkara\DinkoApi\Http\Controllers\ResourceController;
use Storage;
use ApiResponse;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;


/**
 * @resource Message
 */
class MessageController extends ResourceController
{

    
    
    public function __construct(IMessageRepo $repo, MessageTransformer $transformer) {
        parent::__construct($repo, $transformer);
	
        $this->middleware('owns.message', ['only' => ['update', 'destroy']]);

        $this->middleware('exists.user:receiver_id,true', ['only' => ['store']]);                
        
        $this->middleware('can.message', ['only' => ['store']]);
        
        $this->middleware('exists.user:poi_id,true', ['only' => ['chat']]);
    
    }
    
    /**
     * Get chat messages
     * 
     * get paginated list of chat messages between two users
     *
     * @param Request $request
     * @param int $poi_id
     * @return \Illuminate\Http\Response
     */
    public function chat(Request $request, $poi_id){
        $id = JWTAuth::parseToken()->toUser()->id;
        
        $page = $request->page ? $request->page : "1";                
        $pagination = $request->pagination ? $request->pagination : "15";
               
        $result = $this->repo->paginatedChat($id, $poi_id, $page, $pagination);                
                
        $paginator = new Paginator($result, $page, $pagination);
        
        return ApiResponse::Pagination($paginator, $this->transformer);                
    }
    
    /**
     * Create item
     * 
     * Store a newly created item in storage.
     *
     * @param  App\Http\Requests\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
    {       
        $data = $request->only($this->repo->getModel()->getFillable());

        $data["sender_id"] = JWTAuth::parseToken()->toUser()->id;   
    
        //dd($data);
        return $this->storeItem($data);
    }

    /**
     * Update item 
     * 
     * Update the specified item in storage.
     *
     * @param  App\Http\Requests\UpdateMessageRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, $id)
    {
        $data = $request->only($this->repo->getModel()->getFillable());        
        $item = $this->repo->find($id);

        $data["sender_id"] = JWTAuth::parseToken()->toUser()->id;   
    
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
    



}