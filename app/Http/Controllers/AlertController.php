<?php

namespace App\Http\Controllers;

use App\Alert;
use Berkayk\OneSignal\OneSignalFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlertController extends Controller
{
    public function send(Request $request){
        $this->validate($request,[
            'lat' => 'double|required',
            'longitude' => 'double|required'
        ]);
        $alert = Alert::create();
        $alert->sender_id =$request->user()->id;
        $alert->coord = $request->get('coord');
        $alert->save();
        foreach ($request->user()->trusted_contacts() as $trusted_contact){
            OneSignalFacade::sendNotificationToUser($request->user()->name." has sent a Distress Signal!", $trusted_contact->player, $url = null, $data = null, $buttons = null, $schedule = null);
        }
        return response()->json(["status"=>true,"message"=>"Successfully sent Alert"])->setStatusCode(200);
    }
    public function fetch(Request $request){
        return response()->json($request->user()->alerts()->get());
    }
}
