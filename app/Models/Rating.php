<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dinkara\RepoBuilder\Traits\ApiModel;

class Rating extends Model
{
    use ApiModel;
    
    
    
    protected $table = "ratings";
       
    /**
     * The attributes by you can search data.
     *
     * @var array
     */
    protected $searchableColumns = ['comment', 'owner', 'avg_rate'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['session_id', 'comment', 'owner', 'avg_rate'];
    
    /**
     * The attributes that are will be shown in transformer
     *
     * @var array
     */
    protected $displayable = ['comment', 'owner', 'avg_rate'];
    
    public $timestamps = true;
    
    public function questions($q = null, $orderBy = null)
    {
        $relation = $this->belongsToMany('App\Models\Question', 'ratings_questions', 'rating_id', 'question_id')->withTimestamps()->withPivot('mark');
        if($q == null && $orderBy == null){
            return $relation;
        }
        return $this->searchRelation($relation, $q, $orderBy);
    }
    public function session()
    {
        return $this->belongsTo('App\Models\Session', 'session_id');
    }

}
