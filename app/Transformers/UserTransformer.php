<?php

namespace App\Transformers;

use App\Models\User;
use Dinkara\DinkoApi\Transformers\ApiTransformer;
/**
 * Description of UserTransformer
 *
 * @author Dinkic
 */
class UserTransformer extends ApiTransformer{
    
    protected $defaultIncludes = ['profile', 'wallet'];
    protected $availableIncludes = ['messages', 'roles', 'socialNetworks'];
    protected $pivotAttributes = ['access_token', 'provider_id'];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(User $item)
    {
        $data = $this->transformFromModel($item, $this->pivotAttributes);
        $data["is_doctor"] = !!$item->doctor;
        $data["is_patient"] = !!$item->patient;
        return $data;
    }
    
    public function includeProfile(User $item)
    { 
       return $this->item($item->profile, new ProfileTransformer());
    }
    public function includeWallet(User $item)
    { 
       return $this->item($item->wallet, new WalletTransformer());
    }
    public function includeMessages(User $item)
    {
       return $this->collection($item->messages, new MessageTransformer());
    }
    public function includeRoles(User $item)
    {
       return $this->collection($item->roles, new RoleTransformer());
    }
    public function includeSocialNetworks(User $item)
    {
       return $this->collection($item->socialNetworks, new SocialNetworkTransformer());
    }


    
}
