<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmailTemplate;
use App\Models\Setting;
use App\Models\Order;
use App\Models\ProviderWithdraw;
use App\Models\Service;
use Mail;
use App\Helpers\MailHelper;
use App\Mail\SendSingleSellerMail;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\City;

use App\Models\ProviderClientReport;
use App\Models\CompleteRequest;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\MessageDocument;
use App\Models\Review;
use App\Models\RefundRequest;
use App\Models\AdditionalService;
use App\Models\AppointmentSchedule;
use File;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $providers = User::where('is_provider', 1)->orderBy('id','desc')->where('status', 1)->get();

        return view('admin.provider', compact('providers'));
    }

    public function pendingProvider(){
        $providers = User::where('is_provider', 1)->where('status', 0)->orderBy('id','desc')->get();

        return view('admin.provider', compact('providers'));
    }



    public function sendEmailToAllProvider(){
        return view('admin.send_email_to_all_provider');
    }

    public function sendMailToAllProvider(Request $request){
        $rules = [
            'subject'=>'required',
            'message'=>'required'
        ];
        $customMessages = [
            'subject.required' => trans('admin_validation.Subject is required'),
            'message.required' => trans('admin_validation.Message is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $providers = User::where('is_provider', 1)->orderBy('id','desc')->get();
        MailHelper::setMailConfig();
        foreach($providers as $provider){
            Mail::to($provider->email)->send(new SendSingleSellerMail($request->subject,$request->message));
        }

        $notification = trans('admin_validation.Email Send Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function sendEmailToProvider($id){
        $user = User::find($id);
        return view('admin.send_provider_email', compact('user'));
    }

    public function sendMailtoSingleProvider(Request $request, $id){
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

    public function show($id){
        $provider = User::where('id', $id)->first();
        $setting = Setting::first();

        $default_avatar = array(
            'image' => $setting->default_avatar
        );
        $default_avatar = (object) $default_avatar;

        $countries = Country::orderBy('name','asc')->where('status',1)->get();
        $states = CountryState::orderBy('name','asc')->where(['status' => 1, 'country_id' => $provider->country_id])->get();
        $cities = City::orderBy('name','asc')->where(['status' => 1, 'country_state_id' => $provider->state_id])->get();

        $orders = Order::where('provider_id', $provider->id)->where('order_status', 'complete')->get();
        $total_sold_service = $orders->count();

        $total_balance = $orders->sum('total_amount');

        $total_withdraw = ProviderWithdraw::where('user_id', $provider->id)->sum('total_amount');

        $current_balance = $total_balance - $total_withdraw;

        $services = Service::where('provider_id', $provider->id)->get();
        $total_service = $services->count();

        return view('admin.show_provider',compact('provider','setting','countries','states','cities','default_avatar','total_sold_service','total_withdraw','total_service','current_balance','total_balance'));

    }

    public function updateProvider(Request $request , $id){
        $provider = User::find($id);
        $rules = [
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$provider->id,
            'phone'=>'required',
            'country'=>'required',
            'state'=>'required',
            'designation'=>'required',
            'address'=>'required',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'email.required' => trans('admin_validation.Email is required'),
            'email.unique' => trans('admin_validation.Email already exist'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'country.required' => trans('admin_validation.Country or region is required'),
            'state.required' => trans('admin_validation.State or province is required'),
            'city.required' => trans('admin_validation.Service area is required'),
            'designation.required' => trans('admin_validation.Desgination is required'),
            'address.required' => trans('admin_validation.Address is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $provider->name = $request->name;
        $provider->phone = $request->phone;
        $provider->country_id = $request->country;
        $provider->state_id = $request->state;
        $provider->city_id = $request->city;
        $provider->designation = $request->designation;
        $provider->address = $request->address;
        $provider->save();

        $notification=trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id){
        $user = User::find($id);
        $user_image = $user->image;

        if($user_image){
            if(File::exists(public_path().'/'.$user_image))unlink(public_path().'/'.$user_image);
        }

        AppointmentSchedule::where('user_id',$id)->delete();
        Review::where('provider_id',$id)->delete();
        $orders = Order::where('provider_id',$id)->get();
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

        $services = Service::where('provider_id', $user->id)->get();

        foreach($services as $service){
            $additionals = AdditionalService::where('service_id', $service->id)->get();
            foreach($additionals as $additional){
                $additional_image = $additional->image;
                if($additional_image){
                    if(File::exists(public_path().'/'.$additional_image))unlink(public_path().'/'.$additional_image);
                }
                $additional->delete();
            }
            $service_image = $service->image;
             if($service_image){
                if(File::exists(public_path().'/'.$service_image))unlink(public_path().'/'.$service_image);
            }
            $service->delete();
        }

        $user->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function changeStatus($id){
        $provider = User::find($id);
        if($provider->status==1){
            $provider->status=0;
            $provider->save();

            Service::where('provider_id', $id)->update(['approve_by_admin' => 0]);

            $message= trans('admin_validation.Inactive Successfully');
        }else{
            $provider->status=1;
            $provider->save();

            Service::where('provider_id', $id)->update(['approve_by_admin' => 1]);

            $message= trans('admin_validation.Active Successfully');
        }
        return response()->json($message);








    }

}
