<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProviderClientReport;
use App\Models\Order;
use App\Models\CompleteRequest;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\Message;
use App\Models\MessageDocument;
use App\Models\Review;

use App\Models\RefundRequest;
use App\Helpers\MailHelper;
use Mail;
use App\Mail\SendSingleSellerMail;
use Image;
use File;
class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $customers = User::orderBy('id','desc')->where('status',1)->get();

        return view('admin.customer', compact('customers'));
    }

    public function pendingCustomerList(){
        $customers = User::orderBy('id','desc')->where('status',0)->get();
        return view('admin.customer', compact('customers'));
    }

    public function show($id){
        $customer = User::find($id);
        if($customer){
            return view('admin.show_customer',compact('customer'));
        }else{
            $notification='Something went wrong';
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('admin.customer-list')->with($notification);
        }

    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user_image = $user->image;
        $user->delete();
        if($user_image){
            if(File::exists(public_path().'/'.$user_image))unlink(public_path().'/'.$user_image);
        }

        Review::where('user_id',$id)->delete();

        Message::where('buyer_id',$id)->delete();
        Message::where('provider_id',$id)->delete();

        $orders = Order::where('client_id',$id)->get();
        foreach($orders as $order){
            CompleteRequest::where('order_id',$order->id)->delete();
            ProviderClientReport::where('order_id',$order->id)->delete();
            RefundRequest::where('order_id',$id)->delete();
            $tickets = Ticket::where('order_id', $order->id)->get();

            foreach($tickets as $ticket){
                $messages = TicketMessage::where('ticket_id', $ticket->id)->delete();
                foreach($messages as $message){
                    $doucments = MessageDocument::where('ticket_message_id', $message->id)->get();
                    foreach($doucments as $doucment){
                        $document_file = $doucment->file_name;
                        if($document_file){
                            if(File::exists(public_path().'/'.$document_file))unlink(public_path().'/'.$document_file);
                        }
                        $doucment->delete();
                    }
                    $message->delete();
                }
                $ticket->delete();
            }
            $order->delete();
        }

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function changeStatus($id){
        $customer = User::find($id);
        if($customer->status == 1){
            $customer->status = 0;
            $customer->save();
            $message = trans('admin_validation.Inactive Successfully');
        }else{
            $customer->status = 1;
            $customer->save();
            $message = trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }

    public function sendEmailToAllUser(){
        return view('admin.send_email_to_all_customer');
    }

    public function sendMailToAllUser(Request $request){
        $rules = [
            'subject'=>'required',
            'message'=>'required'
        ];
        $customMessages = [
            'subject.required' => trans('admin_validation.Subject is required'),
            'message.required' => trans('admin_validation.Message is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $users = User::where('status',1)->get();
        MailHelper::setMailConfig();
        foreach($users as $user){
            Mail::to($user->email)->send(new SendSingleSellerMail($request->subject,$request->message));
        }

        $notification = trans('admin_validation.Email Send Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function sendMailToSingleUser(Request $request, $id){
        $rules = [
            'subject'=>'required',
            'message'=>'required'
        ];
        $customMessages = [
            'subject.required' => trans('admin_validation.Subject is required'),
            'message.required' => trans('admin_validation.Message is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = User::find($id);
        MailHelper::setMailConfig();
        Mail::to($user->email)->send(new SendSingleSellerMail($request->subject,$request->message));

        $notification = trans('admin_validation.Email Send Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

}
