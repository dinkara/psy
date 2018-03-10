<?php

namespace App\Repositories\Rating;

use Dinkara\RepoBuilder\Repositories\IRepo;
use App\Models\Question;

/**
 * Interface RatingRepository
 * @package App\Repositories\Rating
 */
interface IRatingRepo extends IRepo {
   
    function attachQuestion(Question $model, array $data = []);


    function detachQuestion(Question $model);


}