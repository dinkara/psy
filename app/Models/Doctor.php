<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dinkara\RepoBuilder\Traits\ApiModel;

class Doctor extends Model
{
    use ApiModel;
    
    
    
    protected $table = "doctors";
       
    /**
     * The attributes by you can search data.
     *
     * @var array
     */
    protected $searchableColumns = ['price', 'duration', 'available'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'company_id', 'price', 'duration', 'available'];
    
    /**
     * The attributes that are will be shown in transformer
     *
     * @var array
     */
    protected $displayable = ['price', 'duration', 'available'];
    
    public $timestamps = true;
    
    public function certificates($q = null, $orderBy = null)
    {
        $relation = $this->hasMany('App\Models\Certificate', 'doctor_id');
        if($q == null && $orderBy == null){
            return $relation;
        }
        return $this->searchRelation($relation, $q, $orderBy);
    }
    public function sessions($q = null, $orderBy = null)
    {
        $relation = $this->hasMany('App\Models\Session', 'doctor_id');
        if($q == null && $orderBy == null){
            return $relation;
        }
        return $this->searchRelation($relation, $q, $orderBy);
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

}
