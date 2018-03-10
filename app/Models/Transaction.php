<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dinkara\RepoBuilder\Traits\ApiModel;

class Transaction extends Model
{
    use ApiModel;
    
    
    
    protected $table = "transactions";
       
    /**
     * The attributes by you can search data.
     *
     * @var array
     */
    protected $searchableColumns = ['amount', 'comment', 'status'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['wallet_id', 'session_id', 'amount', 'comment'];
    
    /**
     * The attributes that are will be shown in transformer
     *
     * @var array
     */
    protected $displayable = ['amount', 'comment', 'status'];
    
    public $timestamps = true;
    
    public function wallet()
    {
        return $this->belongsTo('App\Models\Wallet', 'wallet_id');
    }
    public function session()
    {
        return $this->belongsTo('App\Models\Session', 'session_id');
    }

}
