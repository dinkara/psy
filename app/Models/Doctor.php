<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dinkara\RepoBuilder\Traits\ApiModel;
use App\Support\Enum\RatingOwners;

class Doctor extends Model
{
    use ApiModel;
    
    
    
    protected $table = "doctors";
       
    /**
     * The attributes by you can search data.
     *
     * @var array
     */
    protected $searchableColumns = ['price', 'user.profile.name'];
    
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
    protected $displayable = ['price', 'duration', 'available', 'rating'];
    
    public $timestamps = true;        
    
    public function getRatingAttribute(){        
        return $this->ratings()->where("owner", RatingOwners::PATIENT)->avg("avg_rate");
    }
    
    
    public function ratings()
    {
        return $this->hasManyThrough('App\Models\Rating', 'App\Models\Session');
    }
    
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
