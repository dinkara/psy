<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Dinkara\RepoBuilder\Traits\ApiModel;

class Wallet extends Model
{
    use ApiModel;
    
    
    
    protected $table = "wallets";
       
    /**
     * The attributes by you can search data.
     *
     * @var array
     */
    protected $searchableColumns = ['total', 'last_calculated_tansaction'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'total', 'last_calculated_tansaction'];
    
    /**
     * The attributes that are will be shown in transformer
     *
     * @var array
     */
    protected $displayable = ['total', 'last_calculated_tansaction'];
    
    public $timestamps = true;
    
    public function transactions($q = null, $orderBy = null)
    {
        $relation = $this->hasMany('App\Models\Transaction', 'wallet_id');
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
