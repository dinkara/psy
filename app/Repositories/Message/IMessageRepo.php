<?php

namespace App\Repositories\Message;

use Dinkara\RepoBuilder\Repositories\IRepo;

/**
 * Interface MessageRepository
 * @package App\Repositories\Message
 */
interface IMessageRepo extends IRepo {
   
    public function paginatedChat($id, $poi_id, $page, $perPage = 15);
    
}