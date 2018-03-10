<?php

namespace App\Repositories\Certificate;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Models\Certificate;



class EloquentCertificate extends EloquentRepo implements ICertificateRepo {


    public function __construct() {

    }

    /**
     * Configure the Model
     * */
    public function model() {
        return new Certificate;
    }
    

    

}
