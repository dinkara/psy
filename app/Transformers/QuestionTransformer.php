<?php

namespace App\Transformers;

use App\Models\Question;
use Dinkara\DinkoApi\Transformers\ApiTransformer;
/**
 * Description of QuestionTransformer
 *
 * @author Dinkic
 */
class QuestionTransformer extends ApiTransformer{
    
    protected $defaultIncludes = [];
    protected $availableIncludes = [];
    protected $pivotAttributes = ['mark'];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Question $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeRatings(Question $item)
    {
       return $this->collection($item->ratings, new RatingTransformer());
    }


    
}
