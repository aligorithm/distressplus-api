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
            'name' => 'string|required',
            'phone' => 'string|required',
            'latitude' => 'string|required',
            'longitude' => 'string|required'
        ]);
        $alert = Alert::create();
        $alert->name = $request->get('name');
        $alert->phone = $request->get('phone');
        $alert->latitude = $request->get('latitude');
        $alert->longitude = $request->get('longitude');
        $alert->sender_id =$request->user()->id;
        $alert->save();
        foreach ($request->user()->trusted_contacts()->get() as $trusted_contact){
            $alert->receivers()->attach($trusted_contact->id);

            OneSignalFacade::sendNotificationToUser($request->user()->name." has sent a Distress Signal!", $trusted_contact->player, $url = null, $data = null, $buttons = null, $schedule = null);
        }
        return response()->json(["status"=>true,"message"=>"Successfully sent Alert"])->setStatusCode(201);
    }
    public function fetch(Request $request){
        return response()->json($request->user()->alerts()->get());
    }
}
