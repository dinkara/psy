<?php

namespace App\Transformers;

use App\Models\Rating;
use Dinkara\DinkoApi\Transformers\ApiTransformer;
/**
 * Description of RatingTransformer
 *
 * @author Dinkic
 */
class RatingTransformer extends ApiTransformer{
    
    protected $defaultIncludes = [];
    protected $availableIncludes = ['session', 'questions'];
    protected $pivotAttributes = ['mark'];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Rating $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeSession(Rating $item)
    { 
       return $this->item($item->session, new SessionTransformer());
    }
    public function includeQuestions(Rating $item)
    {
       return $this->collection($item->questions, new QuestionTransformer());
    }


    
}
