<?php

namespace App\Transformers;

use App\Models\Wallet;
use Dinkara\DinkoApi\Transformers\ApiTransformer;
/**
 * Description of WalletTransformer
 *
 * @author Dinkic
 */
class WalletTransformer extends ApiTransformer{
    
    protected $defaultIncludes = [];
    protected $availableIncludes = ['user', 'transactions'];
    protected $pivotAttributes = [];
    
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Wallet $item)
    {
        return $this->transformFromModel($item, $this->pivotAttributes);
    }
    
    public function includeUser(Wallet $item)
    { 
       return $this->item($item->user, new UserTransformer());
    }
    public function includeTransactions(Wallet $item)
    {
       return $this->collection($item->transactions, new TransactionTransformer());
    }


    
}
