<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Support\Enum;

/**
 * Description of SessionStatuses
 *
 * @author Dinkic
 */
class SessionStatuses {
    
    const COMPLETED = "completed";
    const CANCELED = "canceled";
    const SCHEDULED = "scheduled";
    const APPROVED = "approved";

    
    public static function all() {
        return [
            self::COMPLETED,
            self::CANCELED,
            self::SCHEDULED,
            self::APPROVED,

        ];
    }
    
    public static function stringify(){
        return implode(",", self::all());
    }
}
