<?php

namespace App\Repositories\Message;

use Dinkara\RepoBuilder\Repositories\EloquentRepo;
use App\Models\Message;



class EloquentMessage extends EloquentRepo implements IMessageRepo {


    public function __construct() {

    }

    /**
     * Configure the Model
     * */
    public function model() {
        return new Message;
    }

    public function paginatedChat($id, $poi_id, $page, $perPage = 15) {
        
        $result = Message::where(function($q) use ($id, $poi_id) {
                        $q->where("sender_id", $id)
                        ->Where("receiver_id", $poi_id);
                    })->orWhere(function($q) use ($id, $poi_id) {
                        $q->where("receiver_id", $id)
                        ->Where("sender_id", $poi_id);
                    })->orderBy('created_at', 'desc')
                    ->skip(($page-1) * $perPage)
                    ->limit($perPage)->get()->reverse();
                            
                                                            
        
        return $result;
    }

}
