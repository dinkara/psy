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

    public function sessionsInRange($start, $end) {
        if (!$this->model) {
            return false;
        }
                       
        $result = $this->model->sessions()->whereDate('start', '>=', $start)->whereDate('start', '<', $end)->orderBy('start', 'asc')->get();
        
        return $result;
    }

}
