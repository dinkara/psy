<?php

namespace App\Repositories\Doctor;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Models\Doctor;



class EloquentDoctor extends EloquentRepo implements IDoctorRepo {


    public function __construct() {

    }

    /**
     * Configure the Model
     * */
    public function model() {
        return new Doctor;
    }
    

    

}
