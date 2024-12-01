<?php

namespace App\Http\Controllers\API\User;

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
        $this->middleware('auth:api');
    }

    public function index(){
        // $buyer = Auth::guard('api')->user();
        // // $buyer = User::find(6);

        // $message = new Message();
        // $message->buyer_id = $buyer->id;
        // $message->provider_id = 2;
        // $message->message = 'this is test message';
        // $message->provider_read_msg = 0;
        // $message->buyer_read_msg = 1;
        // $message->send_by = 'buyer';
        // $message->save();

        // $data = array([
        //     'buyer_id' => $buyer->id,
        //     'message_id' => $message->id
        // ]);

        // $user = User::find(2);

        // event(new BuyerProviderMessage($data, $user));

        // return response()->json(['data' => $data]);


        $provider = Auth::guard('api')->user();

        $buyers = Message::with('provider')->where(['buyer_id' => $provider->id])->select('provider_id')->groupBy('provider_id')->orderBy('id','desc')->get();

        $setting = Setting::first();
        $default_avatar = (object) array(
            'image' => $setting->default_avatar
        );

        return response()->json([
            'buyers' => $buyers,
            'default_avatar' => $default_avatar
        ]);
    }

    public function load_chat_box($id){
        $buyer = Auth::guard('api')->user();

        $provider = User::find($id);

        $messages =  Message::with('service')->where(['buyer_id' => $buyer->id, 'provider_id' => $id])->get();

        Message::where(['buyer_id' => $buyer->id, 'provider_id' => $id])->update(['buyer_read_msg' => 1]);

        return response()->json([
            'messages' => $messages,
            'buyer' => $buyer,
            'provider' => $provider
        ]);
    }

    public function send_message_to_provider(Request $request){

        $buyer = Auth::guard('api')->user();

        $message = new Message();
        $message->provider_id = $request->provider_id;
        $message->buyer_id = $buyer->id;
        $message->message = $request->message;
        $message->provider_read_msg = 0;
        $message->buyer_read_msg = 1;
        $message->send_by = 'buyer';
        $message->service_id = $request->service_id ? $request->service_id : 0;
        $message->save();

        $provider = User::find($request->provider_id);

        $messages =  Message::with('service')->where(['provider_id' => $provider->id, 'buyer_id' => $buyer->id])->get();

        $data = array([
            'buyer_id' => $buyer->id,
            'message_id' => $message->id
        ]);

        event(new BuyerProviderMessage($data, $provider));

        return response()->json([
            'messages' => $messages,
            'buyer' => $buyer,
            'provider' => $provider
        ]);

    }
}
