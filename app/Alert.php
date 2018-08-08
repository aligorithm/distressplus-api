<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'sender_id','coord'
    ];

    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
}
