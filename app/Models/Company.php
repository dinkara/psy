<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dinkara\RepoBuilder\Traits\ApiModel;

class Company extends Model
{
    use ApiModel;
    
    
    
    protected $table = "companies";
       
    /**
     * The attributes by you can search data.
     *
     * @var array
     */
    protected $searchableColumns = ['name', 'address', 'city', 'country', 'zip'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'address', 'city', 'country', 'zip'];
    
    /**
     * The attributes that are will be shown in transformer
     *
     * @var array
     */
    protected $displayable = ['name', 'address', 'city', 'country', 'zip'];
    
    public $timestamps = true;
    
    public function doctors($q = null, $orderBy = null)
    {
        $relation = $this->hasMany('App\Models\Doctor', 'company_id');
        if($q == null && $orderBy == null){
            return $relation;
        }
        return $this->searchRelation($relation, $q, $orderBy);
    }

}
