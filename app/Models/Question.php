<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dinkara\RepoBuilder\Traits\ApiModel;

class Question extends Model
{
    use ApiModel;
    
    
    
    protected $table = "questions";
       
    /**
     * The attributes by you can search data.
     *
     * @var array
     */
    protected $searchableColumns = ['text', 'type'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text', 'type'];
    
    /**
     * The attributes that are will be shown in transformer
     *
     * @var array
     */
    protected $displayable = ['text', 'type'];
    
    public $timestamps = true;
    
    public function ratings($q = null, $orderBy = null)
    {
        $relation = $this->belongsToMany('App\Models\Rating', 'ratings_questions', 'question_id', 'rating_id')->withTimestamps()->withPivot('mark');
        if($q == null && $orderBy == null){
            return $relation;
        }
        return $this->searchRelation($relation, $q, $orderBy);
    }

}
