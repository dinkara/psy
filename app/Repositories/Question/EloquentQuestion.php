<?php

namespace App\Repositories\Question;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Models\Question;
use App\Support\Enum\QuestionTypes;


class EloquentQuestion extends EloquentRepo implements IQuestionRepo {


    public function __construct() {

    }

    /**
     * Configure the Model
     * */
    public function model() {
        return new Question;
    }

    public function doctorQuestions() {
        if (!$this->model)
            $this->initialize();
        
        return $this->model->where("type", QuestionTypes::BOTH)->orWhere("type", QuestionTypes::DOCTOR)->get();
    }

    public function patientQuestions() {
        if (!$this->model)
            $this->initialize();
        
        return $this->model->where("type", QuestionTypes::BOTH)->orWhere("type", QuestionTypes::PATIENT)->get();
    }

}
