<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BreadcrumbImage;
use App\Models\User;
use App\Models\GoogleRecaptcha;
use App\Models\Setting;
use App\Models\Order;
use App\Models\Review;
use App\Models\RefundRequest;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\MessageDocument;
use App\Models\Message;

use App\Rules\Captcha;
use Image;
use File;
use Str;
use Hash;
use Slug;
use Auth;
use Session;

use App\Events\SellerToUser;
use App\Models\ProviderClientReport;
use App\Models\CompleteRequest;
use App\Helpers\MailHelper;
use Mail;
use App\Mail\SendSingleSellerMail;
use Modules\JobPost\Entities\JobPost;
use Modules\JobPost\Http\Requests\JobPostRequest;

class UserProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }
    public function dashboard(){
        $breadcrumb = BreadcrumbImage::where(['id' => 10])->first();
        $user = Auth::guard('web')->user();

        $job_posts = JobPost::with('user','category')->where('user_id',$user->id)->latest()->paginate(5);

        if($user->is_provider == 1){
            return redirect()->route('provider.dashboard');
        }

        $user = User::select('id','name','email','image','phone','address','status','is_provider')->where('id', $user->id)->first();

        $setting = Setting::first();
        $currency_icon = (object) array('icon' => $setting->currency_icon);
        $default_avatar = (object) array('image' => $setting->default_avatar);

        $orders = Order::orderBy('id','desc')->select('id', 'order_id', 'client_id', 'total_amount', 'booking_date', 'order_status')->where('client_id', $user->id)->paginate(10);

        $complete_order = $orders->where('order_status','complete')->count();
        $active_order = $orders->where('order_status','approved_by_provider')->count();
        $total_order = $orders->count();

        $reviews = Review::with('service')->where('user_id', $user->id)->paginate(10);

        $tickets = Ticket::with('user','order','unSeenUserMessage')->where('user_id', $user->id)->orderBy('id','desc')->paginate(10);

        $selected_theme = Session::get('selected_theme');
        if ($selected_theme == 'theme_one'){
            $active_theme = 'layout';
        }elseif($selected_theme == 'theme_two'){
            $active_theme = 'layout2';
        }elseif($selected_theme == 'theme_three'){
            $active_theme = 'layout3';
        }else{
            $active_theme = 'layout';
        }

        return view('user.dashboard')->with([
            'active_theme' => $active_theme,
            'breadcrumb' => $breadcrumb,
            'user' => $user,
            'default_avatar' => $default_avatar,
            'complete_order' => $complete_order,
            'active_order' => $active_order,
            'total_order' => $total_order,
            'orders' => $orders,
            'currency_icon' => $currency_icon,
            'reviews' => $reviews,
            'tickets' => $tickets,
            'job_posts' => $job_posts,
        ]);
    }

    public function show_ticket($id){
        $ticket = Ticket::with('user','order')->where('ticket_id', $id)->first();
        TicketMessage::where('ticket_id', $ticket->id)->update(['unseen_user' => 1]);
        $messages = TicketMessage::where('ticket_id', $ticket->id)->get();
        return view('user.show_ticket', compact('ticket','messages'));
    }

    public function send_ticket_message(Request $request){
        $rules = [
            'ticket_id'=>'required',
            'message'=>'required',
            'user_id'=>'required',
            'documents' => 'max:2048'
        ];
        $customMessages = [
            'message.required' => trans('user_validation.Message is required'),
            'ticket_id.required' => trans('user_validation.Ticket is required'),
            'user_id.required' => trans('user_validation.User is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('web')->user();
        $message = new TicketMessage();
        $message->ticket_id = $request->ticket_id;
        $message->admin_id = 0;
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->message_from = 'client';
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


        $ticket = Ticket::with('user','order')->where('id', $request->ticket_id)->first();
        $messages = TicketMessage::where('ticket_id', $request->ticket_id)->get();

        return view('user.ticket_message_list', compact('messages','ticket'));
    }

    public function ticket_request(Request $request){
        $user = Auth::guard('web')->user();
        $rules = [
            'order_id'=>'required',
            'subject'=>'required',
            'message'=>'required',
        ];
        $customMessages = [
            'order_id.required' => trans('user_validation.Order id is required'),
            'subject.required' => trans('user_validation.Subject is required'),
            'message.required' => trans('user_validation.Message is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $ticket = new Ticket();
        $ticket->user_id = $user->id;
        $ticket->order_id = $request->order_id;
        $ticket->subject = $request->subject;
        $ticket->ticket_id = substr(rand(0,time()),0,10);
        $ticket->status = 'pending';
        $ticket->ticket_from = 'Client';
        $ticket->save();

        $message = new TicketMessage();
        $message->ticket_id = $ticket->id;
        $message->admin_id = 0;
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->message_from = 'client';
        $message->unseen_user = 1;
        $message->unseen_admin = 0;
        $message->save();

        $notification = trans('user_validation.Ticket created successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function mark_as_a_complete($id){
        $order = Order::find($id);
        $order->order_status = 'complete';
        $order->save();

        $notification = trans('user_validation.Mark as a completed successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function mark_as_a_declined($id){
        $order = Order::find($id);
        $order->order_status = 'order_decliened_by_client';
        $order->save();

        $notification = trans('user_validation.Mark as a declined successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function send_refund_request(Request $request){
        $user = Auth::guard('web')->user();
        $rules = [
            'order_id'=>'required',
            'resone'=>'required',
            'account_information'=>'required',
        ];
        $customMessages = [
            'order_id.required' => trans('user_validation.Order id is required'),
            'resone.required' => trans('user_validation.Reasone is required'),
            'account_information.required' => trans('user_validation.Account information is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $refund = new RefundRequest();
        $refund->client_id = $user->id;
        $refund->resone = $request->resone;
        $refund->order_id = $request->order_id;
        $refund->account_information = $request->account_information;
        $refund->save();

        $notification = trans('user_validation.Refund request successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function get_invoice($id){

        $order = Order::with('client','provider','service','refundRequest','completeRequest')->orderBy('id','desc')->where('order_id',$id)->first();
        $title = trans('user_validation.Booking Details');
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        $booking_address = json_decode($order->client_address);
        $package_features = json_decode($order->package_features);

        $additional_services = json_decode($order->additional_services);
        $client = $order->client;
        $provider = $order->provider;

        $refundRequest = $order->refundRequest;
        $completeRequest = $order->completeRequest;

        return view('user.invoice',compact('order','currency_icon','booking_address','package_features','additional_services','client','provider','refundRequest','completeRequest'));

    }

    public function updateProfile(Request $request){
        $user = Auth::guard('web')->user();
        $rules = [
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$user->id,
            'phone'=>'required',
            'address'=>'required',
        ];
        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'email.required' => trans('user_validation.Email is required'),
            'email.unique' => trans('user_validation.Email already exist'),
            'phone.required' => trans('user_validation.Phone is required'),
            'address.required' => trans('user_validation.Address is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        $image_upload = false;

        if($request->file('image')){
            $old_image=$user->image;
            $user_image=$request->image;
            $extention=$user_image->getClientOriginalExtension();
            $image_name= Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/custom-images/'.$image_name;

            Image::make($user_image)
                ->save(public_path().'/'.$image_name);

            $user->image=$image_name;
            $user->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
            $image_upload = true;
        }

        $user = User::select('id','name','email','image','phone','address','status','is_provider')->where('id', $user->id)->first();


        $notification = trans('user_validation.Update Successfully');
        return response()->json(['status' => 'success', 'message' => $notification, 'image_upload' => $image_upload, 'user' => $user]);
    }

    public function updatePassword(Request $request){
        $rules = [
            'current_password'=>'required',
            'password'=>'required|min:4|confirmed',
        ];
        $customMessages = [
            'current_password.required' => trans('user_validation.Current password is required'),
            'password.required' => trans('user_validation.Password is required'),
            'password.min' => trans('user_validation.Password minimum 4 character'),
            'password.confirmed' => trans('user_validation.Confirm password does not match'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('web')->user();
        if(Hash::check($request->current_password, $user->password)){
            $user->password = Hash::make($request->password);
            $user->save();

            $notification = 'Password change successfully';
            return response()->json(['status' => 'success' , 'message' => $notification],200);

        }else{
            $notification = trans('user_validation.Current password does not match');
            return response()->json(['status' => 'faild' , 'message' => $notification],403);
        }
    }

    public function order(){
        $user = Auth::guard('web')->user();
        $orders = Order::orderBy('id','desc')->where('user_id', $user->id)->paginate(10);
        $setting = Setting::first();
        return view('user.order', compact('orders','setting'));
    }

    public function pendingOrder(){
        $user = Auth::guard('web')->user();
        $orders = Order::orderBy('id','desc')->where('user_id', $user->id)->where('order_status',0)->paginate(10);
        $setting = Setting::first();
        return view('user.order', compact('orders','setting'));
    }

    public function completeOrder(){
        $user = Auth::guard('web')->user();
        $orders = Order::orderBy('id','desc')->where('user_id', $user->id)->where('order_status',3)->paginate(10);
        $setting = Setting::first();
        return view('user.order', compact('orders','setting'));
    }

    public function declinedOrder(){
        $user = Auth::guard('web')->user();
        $orders = Order::orderBy('id','desc')->where('user_id', $user->id)->where('order_status',4)->paginate(10);
        $setting = Setting::first();
        return view('user.order', compact('orders','setting'));
    }

    public function orderShow($orderId){
        $user = Auth::guard('web')->user();
        $order = Order::where('user_id', $user->id)->where('order_id',$orderId)->first();
        $setting = Setting::first();
        $products = Product::all();
        return view('user.show_order', compact('order','setting','products'));
    }


    public function wishlist(){
        $user = Auth::guard('web')->user();
        $wishlists = Wishlist::where(['user_id' => $user->id])->paginate(10);
        $setting = Setting::first();
        return view('user.wishlist', compact('wishlists','setting'));
    }

    public function myProfile(){
        $user = Auth::guard('web')->user();
        $countries = Country::orderBy('name','asc')->where('status',1)->get();
        $states = CountryState::orderBy('name','asc')->where(['status' => 1, 'country_id' => $user->country_id])->get();
        $cities = City::orderBy('name','asc')->where(['status' => 1, 'country_state_id' => $user->state_id])->get();

        $setting = Setting::first();
        $default_avatar = array(
            'image' => $setting->default_avatar
        );
        $default_avatar = (object) $default_avatar;
        return view('user.my_profile', compact('user','countries','cities','states','default_avatar'));
    }




    public function changePassword(){
        return view('user.change_password');
    }



    public function address(){
        $user = Auth::guard('web')->user();
        $billing = BillingAddress::where('user_id', $user->id)->first();
        $shipping = ShippingAddress::where('user_id', $user->id)->first();
        return view('user.address', compact('billing','shipping'));
    }

    public function editBillingAddress(){
        $user = Auth::guard('web')->user();
        $billing = BillingAddress::where('user_id', $user->id)->first();
        $countries = Country::orderBy('name','asc')->where('status',1)->get();

        if($billing){
            $states = CountryState::orderBy('name','asc')->where(['status' => 1, 'country_id' => $billing->country_id])->get();
            $cities = City::orderBy('name','asc')->where(['status' => 1, 'country_state_id' => $billing->state_id])->get();
        }else{
            $states = CountryState::orderBy('name','asc')->where(['status' => 1, 'country_id' => 0])->get();
            $cities = City::orderBy('name','asc')->where(['status' => 1, 'country_state_id' => 0])->get();
        }
        return view('user.edit_billing_address', compact('billing','countries','states','cities'));
    }

    public function updateBillingAddress(Request $request){
        $rules = [
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'country'=>'required',
            'address'=>'required',
        ];

        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'email.required' => trans('user_validation.Email is required'),
            'email.unique' => trans('user_validation.Email already exist'),
            'phone.required' => trans('user_validation.Phone is required'),
            'country.required' => trans('user_validation.Country is required'),
            'zip_code.required' => trans('user_validation.Zip code is required'),
            'address.required' => trans('user_validation.Address is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('web')->user();
        $billing = BillingAddress::where('user_id', $user->id)->first();
        if($billing){
            $billing->name = $request->name;
            $billing->email = $request->email;
            $billing->phone = $request->phone;
            $billing->country_id = $request->country;
            $billing->state_id = $request->state;
            $billing->city_id = $request->city;
            $billing->zip_code = $request->zip_code;
            $billing->address = $request->address;
            $billing->save();

            $notification = trans('user_validation.Update Successfully');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('user.address')->with($notification);
        }else{
            $billing = new BillingAddress();
            $billing->user_id = $user->id;
            $billing->name = $request->name;
            $billing->email = $request->email;
            $billing->phone = $request->phone;
            $billing->country_id = $request->country;
            $billing->state_id = $request->state;
            $billing->city_id = $request->city;
            $billing->zip_code = $request->zip_code;
            $billing->address = $request->address;
            $billing->save();

            $notification = trans('user_validation.Update Successfully');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('user.address')->with($notification);
        }
    }


    public function editShippingAddress(){
        $user = Auth::guard('web')->user();
        $shipping = ShippingAddress::where('user_id', $user->id)->first();
        $countries = Country::orderBy('name','asc')->where('status',1)->get();

        if($shipping){
            $states = CountryState::orderBy('name','asc')->where(['status' => 1, 'country_id' => $shipping->country_id])->get();
            $cities = City::orderBy('name','asc')->where(['status' => 1, 'country_state_id' => $shipping->state_id])->get();
        }else{
            $states = CountryState::orderBy('name','asc')->where(['status' => 1, 'country_id' => 0])->get();
            $cities = City::orderBy('name','asc')->where(['status' => 1, 'country_state_id' => 0])->get();
        }
        return view('user.edit_shipping_address', compact('shipping','countries','states','cities'));
    }

    public function updateShippingAddress(Request $request){
        $rules = [
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'country'=>'required',
            'address'=>'required',
        ];

        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'email.required' => trans('user_validation.Email is required'),
            'email.unique' => trans('user_validation.Email already exist'),
            'phone.required' => trans('user_validation.Phone is required'),
            'country.required' => trans('user_validation.Country is required'),
            'zip_code.required' => trans('user_validation.Zip code is required'),
            'address.required' => trans('user_validation.Address is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('web')->user();
        $shipping = ShippingAddress::where('user_id', $user->id)->first();
        if($shipping){
            $shipping->name = $request->name;
            $shipping->email = $request->email;
            $shipping->phone = $request->phone;
            $shipping->country_id = $request->country;
            $shipping->state_id = $request->state;
            $shipping->city_id = $request->city;
            $shipping->zip_code = $request->zip_code;
            $shipping->address = $request->address;
            $shipping->save();

            $notification = trans('user_validation.Update Successfully');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('user.address')->with($notification);
        }else{
            $shipping = new ShippingAddress();
            $shipping->user_id = $user->id;
            $shipping->name = $request->name;
            $shipping->email = $request->email;
            $shipping->phone = $request->phone;
            $shipping->country_id = $request->country;
            $shipping->state_id = $request->state;
            $shipping->city_id = $request->city;
            $shipping->zip_code = $request->zip_code;
            $shipping->address = $request->address;
            $shipping->save();

            $notification = trans('user_validation.Update Successfully');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('user.address')->with($notification);
        }
    }


    public function stateByCountry($id){
        $states = CountryState::where(['status' => 1, 'country_id' => $id])->get();
        $response='<option value="0">Select a State</option>';
        if($states->count() > 0){
            foreach($states as $state){
                $response .= "<option value=".$state->id.">".$state->name."</option>";
            }
        }
        return response()->json(['states'=>$response]);
    }

    public function cityByState($id){
        $cities = City::where(['status' => 1, 'country_state_id' => $id])->get();
        $response='<option value="0">Select a City</option>';
        if($cities->count() > 0){
            foreach($cities as $city){
                $response .= "<option value=".$city->id.">".$city->name."</option>";
            }
        }
        return response()->json(['cities'=>$response]);
    }

    public function sellerRegistration(){
        $setting = Setting::first();
        return view('user.seller_registration', compact('setting'));
    }

    public function sellerRequest(Request $request){

        $user = Auth::guard('web')->user();
        $seller = Vendor::where('user_id',$user->id)->first();
        if($seller){
            $notification = 'Request Already exist';
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $rules = [
            'banner_image'=>'required',
            'shop_name'=>'required|unique:vendors',
            'email'=>'required|unique:vendors',
            'phone'=>'required',
            'address'=>'required',
            'open_at'=>'required',
            'closed_at'=>'required',
            'agree_terms_condition' => 'required'
        ];

        $customMessages = [
            'banner_image.required' => trans('user_validation.Name is required'),
            'shop_name.required' => trans('user_validation.Shop name is required'),
            'shop_name.unique' => trans('user_validation.Shop name already exist'),
            'email.required' => trans('user_validation.Email is required'),
            'email.unique' => trans('user_validation.Email already exist'),
            'phone.required' => trans('user_validation.Phone is required'),
            'address.required' => trans('user_validation.Address is required'),
            'open_at.required' => trans('user_validation.Open at is required'),
            'closed_at.required' => trans('user_validation.Close at is required'),
            'agree_terms_condition.required' => trans('user_validation.Agree field is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('web')->user();
        $seller = new Vendor();
        $seller->shop_name = $request->shop_name;
        $seller->slug = Str::slug($request->shop_name);
        $seller->email = $request->email;
        $seller->phone = $request->phone;
        $seller->address = $request->address;
        $seller->description = $request->about;
        $seller->greeting_msg = trans('user_validation.Welcome to'). ' '. $request->shop_name;
        $seller->open_at = $request->open_at;
        $seller->closed_at = $request->closed_at;
        $seller->user_id = $user->id;
        $seller->seo_title = $request->shop_name;
        $seller->seo_description = $request->shop_name;

        if($request->banner_image){
            $exist_banner = $seller->banner_image;
            $extention = $request->banner_image->getClientOriginalExtension();
            $banner_name = 'seller-banner'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/custom-images/'.$banner_name;
            Image::make($request->banner_image)
                ->save(public_path().'/'.$banner_name);
            $seller->banner_image = $banner_name;
            $seller->save();
            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }
        $seller->save();
        $notification = trans('user_validation.Request sumited successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('user.dashboard')->with($notification);

    }



    public function addToWishlist($id){
        $user = Auth::guard('web')->user();
        $product = Product::find($id);
        $isExist = Wishlist::where(['user_id' => $user->id, 'product_id' => $product->id])->count();
        if($isExist == 0){
            $wishlist = new Wishlist();
            $wishlist->product_id = $id;
            $wishlist->user_id = $user->id;
            $wishlist->save();
            $message = trans('user_validation.Wishlist added successfully');
            return response()->json(['status' => 1, 'message' => $message]);
        }else{
            $message = trans('user_validation.Already added');
            return response()->json(['status' => 0, 'message' => $message]);
        }
    }

    public function removeWishlist($id){
        $wishlist = Wishlist::find($id);
        $wishlist->delete();
        $notification = trans('user_validation.Removed successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function storeProductReport(Request $request){
        if($request->subject == null){
            $message = trans('user_validation.Subject filed is required');
            return response()->json(['status' => 0, 'message' => $message]);
        }
        if($request->description == null){
            $message = trans('user_validation.Description filed is required');
            return response()->json(['status' => 0, 'message' => $message]);
        }
        $user = Auth::guard('web')->user();
        $report = new ProductReport();
        $report->user_id = $user->id;
        $report->seller_id = $request->seller_id;
        $report->product_id = $request->product_id;
        $report->subject = $request->subject;
        $report->description = $request->description;
        $report->save();

        $message = trans('user_validation.Report Submited successfully');
        return response()->json(['status' => 1, 'message' => $message]);

    }

    public function review(){
        $user = Auth::guard('web')->user();
        $reviews = ProductReview::orderBy('id','desc')->where(['user_id' => $user->id, 'status' => 1])->paginate(10);
        return view('user.review',compact('reviews'));
    }


    public function storeProductReview(Request $request){
        $rules = [
            'rating'=>'required',
            'review'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'rating.required' => trans('user_validation.Rating is required'),
            'review.required' => trans('user_validation.Review is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('web')->user();
        $isExistOrder = false;
        $orders = Order::where(['user_id' => $user->id])->get();
        foreach ($orders as $key => $order) {
            foreach ($order->orderProducts as $key => $orderProduct) {
                if($orderProduct->product_id == $request->product_id){
                    $isExistOrder = true;
                }
            }
        }

        if($isExistOrder){
            $isReview = ProductReview::where(['product_id' => $request->product_id, 'user_id' => $user->id])->count();
            if($isReview > 0){
                $message = trans('user_validation.You have already submited review');
                return response()->json(['status' => 0, 'message' => $message]);
            }
            $review = new ProductReview();
            $review->user_id = $user->id;
            $review->rating = $request->rating;
            $review->review = $request->review;
            $review->product_vendor_id = $request->seller_id;
            $review->product_id = $request->product_id;
            $review->save();
            $message = trans('user_validation.Review Submited successfully');
            return response()->json(['status' => 1, 'message' => $message]);
        }else{
            $message = trans('user_validation.Opps! You can not review this product');
            return response()->json(['status' => 0, 'message' => $message]);
        }

    }

    public function updateReview(Request $request, $id){
        $rules = [
            'rating'=>'required',
            'review'=>'required',
        ];
        $this->validate($request, $rules);
        $user = Auth::guard('web')->user();
        $review = ProductReview::find($id);
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->save();

        $notification = trans('user_validation.Updated successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function delete_account(){
        $user = Auth::guard('web')->user();

        $id = $user->id;

        $user_image = $user->image;

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
              $messages = TicketMessage::where('ticket_id', $ticket->id)->get();
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

        User::where('id',$id)->delete();
        Auth::guard('web')->logout();

        $notification = trans('user_validation.Deleted Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('home')->with($notification);

    }


}
