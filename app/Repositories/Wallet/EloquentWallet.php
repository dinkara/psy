<?php

namespace App\Repositories\Wallet;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Models\Wallet;



class EloquentWallet extends EloquentRepo implements IWalletRepo {


    public function __construct() {

    }

    /**
     * Configure the Model
     * */
    public function model() {
        return new Wallet;
    }
    

    

}
