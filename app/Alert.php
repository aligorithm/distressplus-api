<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'user_id','coord'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
}
