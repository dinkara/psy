<?php

namespace App\Repositories\Message;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Models\Message;



class EloquentMessage extends EloquentRepo implements IMessageRepo {


    public function __construct() {

    }

    /**
     * Configure the Model
     * */
    public function model() {
        return new Message;
    }
    

    

}
