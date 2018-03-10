<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dinkara\RepoBuilder\Traits\ApiModel;

class Note extends Model
{
    use ApiModel;
    
    
    
    protected $table = "notes";
       
    /**
     * The attributes by you can search data.
     *
     * @var array
     */
    protected $searchableColumns = ['text'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text', 'session_id'];
    
    /**
     * The attributes that are will be shown in transformer
     *
     * @var array
     */
    protected $displayable = ['text'];
    
    public $timestamps = true;
    
    public function session()
    {
        return $this->belongsTo('App\Models\Session', 'session_id');
    }

}
