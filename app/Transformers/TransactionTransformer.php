<?php

namespace App\Transformers;

use App\Models\Transaction;
use Dinkara\DinkoApi\Transformers\ApiTransformer;
/**
 * Description of TransactionTransformer
 *
 * @author Dinkic
 */
class TransactionTransformer extends ApiTransformer{
    
    protected $defaultIncludes = [];
    protected $availableIncludes = ['session', 'wallet'];
    protected $pivotAttributes = [];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Transaction $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeSession(Transaction $item)
    { 
       return $this->item($item->session, new SessionTransformer());
    }
    public function includeWallet(Transaction $item)
    { 
       return $this->item($item->wallet, new WalletTransformer());
    }


    
}
