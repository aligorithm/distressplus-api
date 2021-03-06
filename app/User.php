<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone','player'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function alerts(){
        return $this->belongsToMany(Alert::class,'alert_panic','user_id','alert_id');
    }

    public function panics(){
        return $this->hasMany(Alert::class,'sender_id');
    }
    public function trusted_contacts(){
        return $this->belongsToMany(User::class, 'truster_trustee', 'truster_id', 'trustee_id');
}
    public function truster_contacts(){
        return $this->belongsToMany(User::class, 'truster_trustee', 'trustee_id', 'truster_id');
}
}
