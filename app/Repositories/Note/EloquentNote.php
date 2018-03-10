<?php

namespace App\Repositories\Note;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Models\Note;



class EloquentNote extends EloquentRepo implements INoteRepo {


    public function __construct() {

    }

    /**
     * Configure the Model
     * */
    public function model() {
        return new Note;
    }
    

    

}
