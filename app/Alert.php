<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $hidden = [];

    public function receivers(){
        return $this->belongsToMany(User::class,'alert_panic','alert_id','user_id');
    }
    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
}
