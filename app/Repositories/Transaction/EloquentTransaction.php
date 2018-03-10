<?php

namespace App\Repositories\Transaction;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Models\Transaction;



class EloquentTransaction extends EloquentRepo implements ITransactionRepo {


    public function __construct() {

    }

    /**
     * Configure the Model
     * */
    public function model() {
        return new Transaction;
    }
    

    

}
