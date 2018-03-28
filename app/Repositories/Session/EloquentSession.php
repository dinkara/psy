<?php

namespace App\Repositories\Session;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Models\Session;
use App\Support\Enum\SessionStatuses;


class EloquentSession extends EloquentRepo implements ISessionRepo {


    public function __construct() {

    }

    /**
     * Configure the Model
     * */
    public function model() {
        return new Session;
    }

    public function cancel() {
        if (!$this->model) {
            return false;
        }
               
        $this->model->status = SessionStatuses::CANCELED;
        $result = $this->model->save();
        
        return $this->finalize($result);
    }

    public function approve() {
        if (!$this->model) {
            return false;
        }
               
        $this->model->status = SessionStatuses::APPROVED;
        $result = $this->model->save();
        
        return $this->finalize($result);
    }
}
