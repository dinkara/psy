<?php

namespace App\Repositories\Rating;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Models\Rating;
use App\Models\Question;



class EloquentRating extends EloquentRepo implements IRatingRepo {


    public function __construct() {

    }

    /**
     * Configure the Model
     * */
    public function model() {
        return new Rating;
    }
    
    public function attachQuestion(Question $model, array $data = []){
        if (!$this->model) {
            return false;
        }	
        
        $result = $this->model->questions()->attach($model, $data);
        
        return $this->finalize($this->model);
    }


    public function detachQuestion(Question $model){
        if (!$this->model) {
            return false;
        }
	
        $result = $this->model->questions()->detach($model);
        
        return $this->finalize($this->model);
    }

    public function refreshAvgRate() {
        if (!$this->model) {
            return false;
        }
        
        $questions = $this->model->questions;
        $count = count($questions);
        $total = 0;
        
        foreach($questions as $quesion){            
            $total += $quesion->pivot->mark;                        
        }
                
        $this->model->avg_rate = $total/$count;
                
        return $this->finalize($this->model->save());
    }

}
