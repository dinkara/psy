<?php

namespace App\Transformers;

use App\Models\Company;
use Dinkara\DinkoApi\Transformers\ApiTransformer;
/**
 * Description of CompanyTransformer
 *
 * @author Dinkic
 */
class CompanyTransformer extends ApiTransformer{
    
    protected $defaultIncludes = [];
    protected $availableIncludes = ['doctors'];
    protected $pivotAttributes = [];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Company $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeDoctors(Company $item)
    {
       return $this->collection($item->doctors, new DoctorTransformer());
    }


    
}
