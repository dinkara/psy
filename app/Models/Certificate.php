<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dinkara\RepoBuilder\Traits\ApiModel;

class Certificate extends Model
{
    use ApiModel;
    
    
    
    protected $table = "certificates";
       
    /**
     * The attributes by you can search data.
     *
     * @var array
     */
    protected $searchableColumns = ['name', 'description', 'url'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['doctor_id', 'name', 'description', 'url'];
    
    /**
     * The attributes that are will be shown in transformer
     *
     * @var array
     */
    protected $displayable = ['name', 'description', 'url'];
    
    public $timestamps = true;
    
    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor', 'doctor_id');
    }

}
