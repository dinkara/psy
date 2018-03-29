<?php

use Illuminate\Database\Seeder;
use App\Repositories\Question\IQuestionRepo;
use App\Support\Enum\QuestionTypes;

class QuestionSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(IQuestionRepo $questionRepo) {
        $doctorQuestions = [
            "Communication",
            "Adherence to schedule",
            "Cooperation",
        ];

        $patientQuestions = [            
            "Quality of work",
            "Skills",
        ];
        
        foreach ($doctorQuestions as $question) {
            $questionRepo->firstOrCreate(["text" => $question, "type" => QuestionTypes::BOTH]);
        }
        
        foreach ($patientQuestions as $question) {
            $questionRepo->firstOrCreate(["text" => $question, "type" => QuestionTypes::PATIENT]);
        }
    }

}

