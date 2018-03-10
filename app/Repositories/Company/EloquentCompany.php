<?php

namespace App\Repositories\Company;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Models\Company;



class EloquentCompany extends EloquentRepo implements ICompanyRepo {


    public function __construct() {

    }

    /**
     * Configure the Model
     * */
    public function model() {
        return new Company;
    }
    

    

}
