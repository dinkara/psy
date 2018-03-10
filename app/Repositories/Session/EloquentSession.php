<?php

namespace App\Repositories\Session;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Models\Session;



class EloquentSession extends EloquentRepo implements ISessionRepo {


    public function __construct() {

    }

    /**
     * Configure the Model
     * */
    public function model() {
        return new Session;
    }
    

    

}
