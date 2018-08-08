<?php

namespace App\Http\Controllers;

use App\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlertController extends Controller
{
    public function send(Request $request){
        $this->validate($request,[
           'user_id' => 'integer|required',
            'lat' => 'double|required',
            'longitude' => 'double|required'
        ]);
        $alert = Alert::create();
        $alert->user_id = $request->get('user_id');
        $alert->sender_id =$request->user()->id;
        $alert->coord = $request->get('coord');
        $alert->save();
    }
}
