<?php

namespace App\Repositories\Doctor;

use Dinkara\RepoBuilder\Repositories\IRepo;

/**
 * Interface DoctorRepository
 * @package App\Repositories\Doctor
 */
interface IDoctorRepo extends IRepo {
   

    function sessionsInRange($start, $end);
}