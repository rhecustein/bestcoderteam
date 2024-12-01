<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Setting;
use Auth;
use App\Events\BuyerProviderMessage;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(){
        $provider = Auth::guard('web')->user();

        $buyers = Message::with('buyer')->where(['provider_id' => $provider->id])->select('buyer_id')->groupBy('buyer_id')->orderBy('id','desc')->get();

        $setting = Setting::first();
        $default_avatar = (object) array(
            'image' => $setting->default_avatar
        );

        return view('provider.live_chat')->with(['buyers' => $buyers, 'default_avatar' => $default_avatar, 'provider' => $provider]);
    }

    public function load_chat_box($id){
        $provider = Auth::guard('web')->user();

        $setting = Setting::first();
        $default_avatar = (object) array(
            'image' => $setting->default_avatar
        );
        $buyer = User::find($id);

        $messages =  Message::where(['provider_id' => $provider->id, 'buyer_id' => $id])->get();

        Message::where(['provider_id' => $provider->id, 'buyer_id' => $id])->update(['provider_read_msg' => 1]);

        return view('provider.chat_box')->with(['messages' => $messages, 'provider' => $provider, 'default_avatar' => $default_avatar, 'buyer' => $buyer]);

    }

    public function send_message_to_buyer(Request $request){

        $provider = Auth::guard('web')->user();

        $message = new Message();
        $message->buyer_id = $request->buyer_id;
        $message->provider_id = $provider->id;
        $message->message = $request->message;
        $message->provider_read_msg = 1;
        $message->buyer_read_msg = 0;
        $message->send_by = 'provider';
        $message->save();


        $setting = Setting::first();
        $default_avatar = (object) array(
            'image' => $setting->default_avatar
        );
        $buyer = User::find($request->buyer_id);

        $messages =  Message::where(['provider_id' => $provider->id, 'buyer_id' => $request->buyer_id])->get();


        $data = array([
            'provider_id' => $provider->id,
            'message_id' => $message->id
        ]);

        event(new BuyerProviderMessage($data, $buyer));

        return view('provider.chat_box')->with(['messages' => $messages, 'provider' => $provider, 'default_avatar' => $default_avatar, 'buyer' => $buyer]);
    }

    public function find_new_buyer($id){
        $buyer = User::select('id','name','image')->find($id);

        $setting = Setting::first();
        $default_avatar = (object) array(
            'image' => $setting->default_avatar
        );

        return response()->json([
            'buyer' => $buyer,
            'default_avatar' => $default_avatar,
        ]);

    }
}
