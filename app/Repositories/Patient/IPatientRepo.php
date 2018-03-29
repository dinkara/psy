<?php

namespace App\Repositories\Patient;

use Dinkara\RepoBuilder\Repositories\IRepo;

/**
 * Interface PatientRepository
 * @package App\Repositories\Patient
 */
interface IPatientRepo extends IRepo {
   
    function sessionsInRange($start, $end);

}