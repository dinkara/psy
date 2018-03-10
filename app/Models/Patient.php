<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dinkara\RepoBuilder\Traits\ApiModel;

class Patient extends Model
{
    use ApiModel;
    
    
    
    protected $table = "patients";
       
    /**
     * The attributes by you can search data.
     *
     * @var array
     */
    protected $searchableColumns = [];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id'];
    
    /**
     * The attributes that are will be shown in transformer
     *
     * @var array
     */
    protected $displayable = [];
    
    public $timestamps = true;
    
    public function sessions($q = null, $orderBy = null)
    {
        $relation = $this->hasMany('App\Models\Session', 'patient_id');
        if($q == null && $orderBy == null){
            return $relation;
        }
        return $this->searchRelation($relation, $q, $orderBy);
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
