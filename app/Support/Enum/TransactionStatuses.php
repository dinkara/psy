<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Support\Enum;

/**
 * Description of TransactionStatuses
 *
 * @author Dinkic
 */
class TransactionStatuses {
    
    const PENDING = "pending";
    const CANCELED = "canceled";
    const PROCESSED = "processed";

    
    public static function all() {
        return [
            self::PENDING,
            self::CANCELED,
            self::PROCESSED,

        ];
    }
    
    public static function stringify(){
        return implode(",", self::all());
    }
}
