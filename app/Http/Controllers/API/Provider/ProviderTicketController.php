<?php

namespace App\Http\Controllers\API\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\MessageDocument;
use App\Models\Order;
use Auth;
use File;

class ProviderTicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        $user = Auth::guard('api')->user();
        $tickets = Ticket::with('user','order','unSeenUserMessage')->where('user_id', $user->id)->orderBy('id','desc')->get();

        return response()->json(['tickets' => $tickets]);
    }

    public function show($id){
        $ticket = Ticket::with('user','order')->where('ticket_id', $id)->first();
        TicketMessage::where('ticket_id', $ticket->id)->update(['unseen_user' => 1]);
        $messages = TicketMessage::where('ticket_id', $ticket->id)->get();

        return response()->json(['ticket' => $ticket, 'messages' => $messages]);
    }

    public function storeMessage(Request $request){
        $rules = [
            'ticket_id'=>'required',
            'message'=>'required',
            'documents' => 'max:2048'
        ];
        $customMessages = [
            'message.required' => trans('user_validation.Message is required'),
            'ticket_id.required' => trans('user_validation.Ticket is required'),
            'user_id.required' => trans('user_validation.User is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('api')->user();
        $message = new TicketMessage();
        $message->ticket_id = $request->ticket_id;
        $message->admin_id = 0;
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->message_from = 'provider';
        $message->unseen_user = 1;
        $message->unseen_admin = 0;
        $message->save();

        if($request->hasFile('documents')){
            foreach($request->documents as $request_file){
                $extention = $request_file->getClientOriginalExtension();
                $file_name = 'support-file-'.time().'.'.$extention;
                $destinationPath = public_path('uploads/custom-images/');
                $request_file->move($destinationPath,$file_name);

                $document = new MessageDocument();
                $document->ticket_message_id = $message->id;
                $document->file_name = $file_name;
                $document->save();
            }
        }

        $firstSmsExist = TicketMessage::where('admin_id', 0)->count();
        if($firstSmsExist == 0){
            $ticket = Ticket::where(['id' => $request->ticket_id])->first();
            $ticket->status = 1;
            $ticket->save();
        }

        $ticket = Ticket::with('user','order')->where('id', $request->ticket_id)->first();
        $messages = TicketMessage::with('documents')->where('ticket_id', $request->ticket_id)->get();
        return response()->json(['ticket' => $ticket, 'messages' => $messages]);
    }


    public function createNewTicket(){
        $user = Auth::guard('api')->user();
        $orders = Order::where('provider_id', $user->id)->orderBy('id','desc')->select('id','order_id','provider_id')->get();

        return response()->json(['orders' => $orders]);
    }

    public function storeNewTicket(Request $request){
        $rules = [
            'order_id'=>'required',
            'subject'=>'required',
            'message'=>'required',
        ];

        $customMessages = [
            'order_id.required' => trans('user_validation.Order id is required'),
            'subject.required' => trans('user_validation.Subject is required'),
            'message.required' => trans('user_validation.Message is required')
        ];
        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('api')->user();

        $ticket = new Ticket();
        $ticket->user_id = $user->id;
        $ticket->order_id = $request->order_id;
        $ticket->subject = $request->subject;
        $ticket->ticket_id = substr(rand(0,time()),0,10);
        $ticket->status = 'pending';
        $ticket->ticket_from = 'provider';
        $ticket->save();

        $message = new TicketMessage();
        $message->ticket_id = $ticket->id;
        $message->admin_id = 0;
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->message_from = 'provider';
        $message->unseen_user = 1;
        $message->unseen_admin = 0;
        $message->save();

        $notification= trans('user_validation.Created Successfully');
        return response()->json(['message' => $notification]);
    }


}
