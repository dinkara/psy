<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dinkara\RepoBuilder\Traits\ApiModel;

class User extends Authenticatable
{
    use ApiModel;
    use SoftDeletes;
    
    /**
     * The attributes by you can search data.
     *
     * @var array
     */
    protected $searchableColumns = ['email', 'password_updated', 'last_login'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password', 'confirmation_code', 'status', 'password_updated'];

    /**
     * The attributes that are will be shown in transformer
     *
     * @var array
     */
    protected $displayable = ['email', 'password_updated', 'last_login'];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
            
    
    /**
     * Get all contacts of user
     */
    public function contacts()
    {
        return $this->hasManyThrough('App\Models\User', 'App\Models\Message', 
                'sender_id', 'id', 'id', 'receiver_id')->distinct();
    }

    public function passwordReset()
    {
        return $this->hasOne('App\Models\PasswordReset', 'user_id');
    }
    public function profile()
    {
        return $this->hasOne('App\Models\Profile', 'user_id');
    }
    public function roles($q = null, $orderBy = null)
    {
        $relation = $this->belongsToMany('App\Models\Role', 'users_roles', 'user_id', 'role_id')->withTimestamps();
        if($q == null && $orderBy == null){
            return $relation;
        }
        return $this->searchRelation($relation, $q, $orderBy);
    }
    public function socialNetworks($q = null, $orderBy = null)
    {
        $relation = $this->belongsToMany('App\Models\SocialNetwork', 'users_social_networks', 'user_id', 'social_network_id')->withTimestamps()->withPivot('access_token', 'provider_id');
        if($q == null && $orderBy == null){
            return $relation;
        }
        return $this->searchRelation($relation, $q, $orderBy);
    }
    public function wallet()
    {
        return $this->hasOne('App\Models\Wallet', 'user_id');
    }
    public function doctor()
    {
        return $this->hasOne('App\Models\Doctor', 'user_id');
    }
    public function patient()
    {
        return $this->hasOne('App\Models\Patient', 'user_id');
    }
    public function sentMessages($q = null, $orderBy = null)
    {
        $relation = $this->hasMany('App\Models\Message', 'sender_id');
        if($q == null && $orderBy == null){
            return $relation;
        }
        return $this->searchRelation($relation, $q, $orderBy);
    }

    public function receivedMessages($q = null, $orderBy = null)
    {
        $relation = $this->hasMany('App\Models\Message', 'receiver_id');
        if($q == null && $orderBy == null){
            return $relation;
        }
        return $this->searchRelation($relation, $q, $orderBy);
    }

    public function messages($q = null, $orderBy = null)
    {
        $sentMessages = $this->sentMessages($q , $orderBy);
        $receivedMessages = $this->receivedMessages($q , $orderBy);
        return array_merge($sentMessages, $receivedMessages);
    }

    public function chat($userId)
    {
        return $this->join('users', 'users.id','messages.sender_id')
            ->join('users', 'users.id','messages.receiver_id')
            ->whereIn('messages.sender_id', [$userId, $this->id])
            ->whereIn('messages.receiver_id', [$userId, $this->id])->get();
    }

}
