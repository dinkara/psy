<?php

namespace App\Transformers;

use App\Models\Session;
use Dinkara\DinkoApi\Transformers\ApiTransformer;
/**
 * Description of SessionTransformer
 *
 * @author Dinkic
 */
class SessionTransformer extends ApiTransformer{
    
    protected $defaultIncludes = ['transaction'];
    protected $availableIncludes = ['notes', 'ratings', 'doctor', 'patient'];
    protected $pivotAttributes = [];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Session $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeTransaction(Session $item)
    { 
       return $this->item($item->transaction, new TransactionTransformer());
    }
    public function includeNotes(Session $item)
    {
       return $this->collection($item->notes, new NoteTransformer());
    }
    public function includeRatings(Session $item)
    {
       return $this->collection($item->ratings, new RatingTransformer());
    }
    public function includeDoctor(Session $item)
    { 
       return $this->item($item->doctor, new DoctorTransformer());
    }
    public function includePatient(Session $item)
    { 
       return $this->item($item->patient, new PatientTransformer());
    }


    
}
