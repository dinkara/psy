<?php

namespace App\Transformers;

use App\Models\Doctor;
use Dinkara\DinkoApi\Transformers\ApiTransformer;
/**
 * Description of DoctorTransformer
 *
 * @author Dinkic
 */
class DoctorTransformer extends ApiTransformer{
    
    protected $defaultIncludes = ['user'];
    protected $availableIncludes = ['certificates', 'company'];
    protected $pivotAttributes = [];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Doctor $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeUser(Doctor $item)
    { 
       return $this->item($item->user, new UserTransformer());
    }
    public function includeCertificates(Doctor $item)
    {
       return $this->collection($item->certificates, new CertificateTransformer());
    }
    public function includeSessions(Doctor $item)
    {
       return $this->collection($item->sessions, new SessionTransformer());
    }
    public function includeCompany(Doctor $item)
    { 
       return $this->item($item->company, new CompanyTransformer());
    }


    
}
