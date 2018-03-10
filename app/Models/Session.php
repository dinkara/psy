<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dinkara\RepoBuilder\Traits\ApiModel;

class Session extends Model
{
    use ApiModel;
    
    
    
    protected $table = "sessions";
       
    /**
     * The attributes by you can search data.
     *
     * @var array
     */
    protected $searchableColumns = ['price', 'start', 'end', 'status'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['doctor_id', 'patient_id', 'price', 'start', 'end'];
    
    /**
     * The attributes that are will be shown in transformer
     *
     * @var array
     */
    protected $displayable = ['price', 'start', 'end', 'status'];
    
    public $timestamps = true;
    
    public function notes($q = null, $orderBy = null)
    {
        $relation = $this->hasMany('App\Models\Note', 'session_id');
        if($q == null && $orderBy == null){
            return $relation;
        }
        return $this->searchRelation($relation, $q, $orderBy);
    }
    public function ratings($q = null, $orderBy = null)
    {
        $relation = $this->hasMany('App\Models\Rating', 'session_id');
        if($q == null && $orderBy == null){
            return $relation;
        }
        return $this->searchRelation($relation, $q, $orderBy);
    }
    public function transaction()
    {
        return $this->hasOne('App\Models\Transaction', 'session_id');
    }
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor', 'doctor_id');
    }
    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'patient_id');
    }

}
