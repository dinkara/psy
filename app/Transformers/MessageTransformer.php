<?php

namespace App\Transformers;

use App\Models\Message;
use Dinkara\DinkoApi\Transformers\ApiTransformer;
/**
 * Description of MessageTransformer
 *
 * @author Dinkic
 */
class MessageTransformer extends ApiTransformer{
    
    protected $defaultIncludes = [];
    protected $availableIncludes = ['sender'];
    protected $pivotAttributes = [];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Message $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeUser(Message $item)
    { 
       return $this->item($item->sender, new UserTransformer());
    }


    
}
