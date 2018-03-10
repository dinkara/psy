<?php

namespace App\Transformers;

use App\Models\Certificate;
use Dinkara\DinkoApi\Transformers\ApiTransformer;
/**
 * Description of CertificateTransformer
 *
 * @author Dinkic
 */
class CertificateTransformer extends ApiTransformer{
    
    protected $defaultIncludes = [];
    protected $availableIncludes = ['doctor'];
    protected $pivotAttributes = [];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Certificate $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeDoctor(Certificate $item)
    { 
       return $this->item($item->doctor, new DoctorTransformer());
    }


    
}
