<?php

namespace App\Transformers;

use App\Models\Patient;
use Dinkara\DinkoApi\Transformers\ApiTransformer;
/**
 * Description of PatientTransformer
 *
 * @author Dinkic
 */
class PatientTransformer extends ApiTransformer{
    
    protected $defaultIncludes = ['user'];
    protected $availableIncludes = [];
    protected $pivotAttributes = [];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Patient $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeUser(Patient $item)
    { 
       return $this->item($item->user, new UserTransformer());
    }
    public function includeSessions(Patient $item)
    {
       return $this->collection($item->sessions, new SessionTransformer());
    }


    
}
