<?php

namespace App\Repositories\Patient;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Models\Patient;



class EloquentPatient extends EloquentRepo implements IPatientRepo {


    public function __construct() {

    }

    /**
     * Configure the Model
     * */
    public function model() {
        return new Patient;
    }
    

    

}
