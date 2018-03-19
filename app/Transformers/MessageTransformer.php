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
    protected $availableIncludes = ['sender', 'receiver'];
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
    
    public function includeSender(Message $item)
    { 
       return $this->item($item->sender, new UserTransformer());
    }

    public function includeReceiver(Message $item)
    { 
       return $this->item($item->receiver, new UserTransformer());
    }
    
}
