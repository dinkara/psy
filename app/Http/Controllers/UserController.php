<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\User\IUserRepo;
use App\Repositories\Profile\IProfileRepo;
use App\Transformers\UserTransformer;
use Tymon\JWTAuth\Facades\JWTAuth;
use Dinkara\DinkoApi\Http\Controllers\ResourceController;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Database\QueryException;
use Storage;
use ApiResponse;
use App\Http\Requests\UserAttachRoleRequest;
use App\Repositories\Role\IRoleRepo;
use App\Http\Requests\UserAttachSocialNetworkRequest;
use App\Repositories\SocialNetwork\ISocialNetworkRepo;
use App\Transformers\RoleTransformer;
use App\Transformers\SocialNetworkTransformer;
use App\Transformers\MessageTransformer;
use App\Transformers\PatientTransformer;
use App\Transformers\DoctorTransformer;


/**
 * @resource User
 */
class UserController extends ResourceController
{

    protected $profileRepo;
    /**
     * @var IRoleRepo 
     */
    private $roleRepo;
        /**
     * @var ISocialNetworkRepo 
     */
    private $socialNetworkRepo;
        
    
    public function __construct(IProfileRepo $profileRepo, IUserRepo $repo, UserTransformer $transformer, IRoleRepo $roleRepo, ISocialNetworkRepo $socialNetworkRepo) {
        parent::__construct($repo, $transformer);
	$this->profileRepo = $profileRepo;
        $this->middleware('exists.role:role_id,true', ['only' => ['attachRole', 'detachRole']]);

        $this->middleware('exists.socialnetwork:social_network_id,true', ['only' => ['attachSocialNetwork', 'detachSocialNetwork']]);

    
    	$this->roleRepo = $roleRepo;
	$this->socialNetworkRepo = $socialNetworkRepo;

    }    
    
    /**
     * Me
     * 
     * Display currently logged in user.
     *     
     * @return \Illuminate\Http\Response
     */
    public function me()
    {
        try {
            $user = JWTAuth::parseToken()->toUser();
            
            if($item = $this->repo->find($user->id)){
                if($item->getModel()->doctor) {
                    return ApiResponse::Item($item->getModel()->doctor, new DoctorTransformer());
                }else{
                    return ApiResponse::Item($item->getModel()->patient, new PatientTransformer());
                }
            }
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }    
        
        return ApiResponse::ItemNotFound($this->repo->getModel());
        
    }
    
    /**
     * Update profile
     * 
     * Update profile info.
     *
     * @param  App\Http\Requests\UpdateProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {       
            try {
                $user = JWTAuth::parseToken()->toUser();
                $data = $request->only(array_keys($request->rules()));

                if( $item = $this->profileRepo->find($user->profile->id)){

                    if($request->file("avatar")){
                        if($item->getModel()->avatar != "user.png") {
                            Storage::delete($item->getModel()->avatar);
                        }

                        $data["avatar"] = $request->file("avatar")->store(config("storage.profiles.avatar"));
                    }

                    $item->update($data);
                    //refresh user after update
                    $item = $this->repo->find($user->id)->getModel();
                    if($item->doctor) {
                        return ApiResponse::ItemUpdated($item->doctor, new DoctorTransformer());
                    }else{
                        return ApiResponse::ItemUpdated($item->patient, new PatientTransformer());
                    }
                }
            } catch (QueryException $e) {
                return ApiResponse::InternalError($e->getMessage());
            }
    }

    /**
     * Get all Role
     *
     * Roles from existing resource.
     *
     * @param Request $request
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function allRoles(Request $request)
    {	   
        try{
            $user = JWTAuth::parseToken()->toUser();
            return ApiResponse::Collection($this->repo->find($user->id)->getModel()->roles($request->q, $request->orderBy)->get(), new RoleTransformer);
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
    }

    /**
     * Paginated Role
     * 
     * Display a list of paginated items .
     *
     * @param Request $request
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function paginatedRoles(Request $request)
    {   
        try{
            $user = JWTAuth::parseToken()->toUser(); 
            if($pagination = $request->pagination){
                return ApiResponse::Pagination($this->repo->find($user->id)->getModel()->roles($request->q, $request->orderBy)->paginate($pagination), new RoleTransformer);                 
            }
            else{
                return ApiResponse::Pagination($this->repo->find($user->id)->getModel()->roles($request->q, $request->orderBy)->paginate(), new RoleTransformer); 
            }   

            
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        } 
    }
    /**
     * Get all SocialNetwork
     *
     * SocialNetworks from existing resource.
     *
     * @param Request $request
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function allSocialNetworks(Request $request)
    {	   
        try{
            $user = JWTAuth::parseToken()->toUser();
            return ApiResponse::Collection($this->repo->find($user->id)->getModel()->socialNetworks($request->q, $request->orderBy)->get(), new SocialNetworkTransformer);
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
    }

    /**
     * Paginated SocialNetwork
     * 
     * Display a list of paginated items .
     *
     * @param Request $request
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function paginatedSocialNetworks(Request $request)
    {   
        try{
            $user = JWTAuth::parseToken()->toUser(); 
            if($pagination = $request->pagination){
                return ApiResponse::Pagination($this->repo->find($user->id)->getModel()->socialNetworks($request->q, $request->orderBy)->paginate($pagination), new SocialNetworkTransformer);                 
            }
            else{
                return ApiResponse::Pagination($this->repo->find($user->id)->getModel()->socialNetworks($request->q, $request->orderBy)->paginate(), new SocialNetworkTransformer); 
            }   

            
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        } 
    }
    /**
     * Get all Message
     *
     * Messages from existing resource.
     *
     * @param Request $request
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function allMessages(Request $request)
    {	   
        try{
            $user = JWTAuth::parseToken()->toUser();
            return ApiResponse::Collection($this->repo->find($user->id)->getModel()->messages($request->q, $request->orderBy)->get(), new MessageTransformer);
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
    }

    /**
     * Paginated Message
     * 
     * Display a list of paginated items .
     *
     * @param Request $request
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function paginatedMessages(Request $request)
    {   
        try{
            $user = JWTAuth::parseToken()->toUser(); 
            if($pagination = $request->pagination){
                return ApiResponse::Pagination($this->repo->find($user->id)->getModel()->messages($request->q, $request->orderBy)->paginate($pagination), new MessageTransformer);                 
            }
            else{
                return ApiResponse::Pagination($this->repo->find($user->id)->getModel()->messages($request->q, $request->orderBy)->paginate(), new MessageTransformer); 
            }   

            
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        } 
    }

    /**
     * Attach Role
     *
     * Attach the Role to existing User.
     *
     * @param  App\Http\Requests\UserAttachRoleRequest  $request
     * @param  int  $role_id
     * @return \Illuminate\Http\Response
     */
    public function attachRole(UserAttachRoleRequest $request, $role_id)
    {
            $data = $request->only(array_keys($request->rules()));

            $user = JWTAuth::parseToken()->toUser();
	    	
	    $model = $this->roleRepo->find($role_id)->getModel();

            return ApiResponse::ItemAttached($this->repo->find($user->id)->attachRole($model, $data)->getModel(), $this->transformer);
    }

        /**
     * Attach SocialNetwork
     *
     * Attach the SocialNetwork to existing User.
     *
     * @param  App\Http\Requests\UserAttachSocialNetworkRequest  $request
     * @param  int  $social_network_id
     * @return \Illuminate\Http\Response
     */
    public function attachSocialNetwork(UserAttachSocialNetworkRequest $request, $social_network_id)
    {
            $data = $request->only(array_keys($request->rules()));

            $user = JWTAuth::parseToken()->toUser();
	    	
	    $model = $this->socialNetworkRepo->find($social_network_id)->getModel();

            return ApiResponse::ItemAttached($this->repo->find($user->id)->attachSocialNetwork($model, $data)->getModel(), $this->transformer);
    }

    
    /**
     * Detach Role
     *
     * Detach the specified resource from existing resource.
     *
     * @param  App\Http\Requests\UserAttachRoleRequest  $request
     * @param  int  $role_id
     * @return \Illuminate\Http\Response
     */
    public function detachRole($role_id)
    {	    	
	$model = $this->roleRepo->find($role_id)->getModel();
        $user = JWTAuth::parseToken()->toUser();
        return ApiResponse::ItemDetached($this->repo->find($user->id)->detachRole($model)->getModel());
    }
    /**
     * Detach SocialNetwork
     *
     * Detach the specified resource from existing resource.
     *
     * @param  App\Http\Requests\UserAttachSocialNetworkRequest  $request
     * @param  int  $social_network_id
     * @return \Illuminate\Http\Response
     */
    public function detachSocialNetwork($social_network_id)
    {	    	
	$model = $this->socialNetworkRepo->find($social_network_id)->getModel();
        $user = JWTAuth::parseToken()->toUser();
        return ApiResponse::ItemDetached($this->repo->find($user->id)->detachSocialNetwork($model)->getModel());
    }

}