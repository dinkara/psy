<?php

namespace App\Transformers;

use App\Models\Note;
use Dinkara\DinkoApi\Transformers\ApiTransformer;
/**
 * Description of NoteTransformer
 *
 * @author Dinkic
 */
class NoteTransformer extends ApiTransformer{
    
    protected $defaultIncludes = [];
    protected $availableIncludes = ['session'];
    protected $pivotAttributes = [];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Note $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeSession(Note $item)
    { 
       return $this->item($item->session, new SessionTransformer());
    }


    
}
