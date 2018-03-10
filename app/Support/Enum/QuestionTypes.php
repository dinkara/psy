<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Support\Enum;

/**
 * Description of QuestionTypes
 *
 * @author Dinkic
 */
class QuestionTypes {
    
    const DOCTOR = "doctor";
    const PATIENT = "patient";
    const BOTH = "both";

    
    public static function all() {
        return [
            self::DOCTOR,
            self::PATIENT,
            self::BOTH,

        ];
    }
    
    public static function stringify(){
        return implode(",", self::all());
    }
}
