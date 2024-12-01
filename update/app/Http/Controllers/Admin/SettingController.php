<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\AdditionalService;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Category;
use App\Models\CompleteRequest;
use App\Models\ContactMessage;
use App\Models\Counter;
use App\Models\CustomPage;
use App\Models\Faq;
use App\Models\FooterLink;
use App\Models\FooterSocialLink;
use App\Models\HowItWork;
use App\Models\Message;
use App\Models\MessageDocument;
use App\Models\Order;
use App\Models\Partner;
use App\Models\PopularPost;
use App\Models\ProviderWithdraw;
use App\Models\RefundRequest;
use App\Models\Review;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\Subscriber;
use App\Models\Testimonial;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use App\Models\WithdrawMethod;
use App\Models\AppointmentSchedule;

use App\Models\Setting;
use App\Models\CookieConsent;
use App\Models\GoogleRecaptcha;
use App\Models\FacebookComment;
use App\Models\TawkChat;
use App\Models\GoogleAnalytic;
use App\Models\SocialLoginInformation;
use App\Models\FacebookPixel;
use App\Models\PusherCredentail;
use App\Models\CustomPagination;
use App\Models\Currency;


use Image;
use File;
use Artisan;
use Validator;
class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function clearDatabase(){
        AdditionalService::truncate();
        AdditionalService::truncate();
        AppointmentSchedule::truncate();
        Blog::truncate();
        BlogCategory::truncate();
        BlogComment::truncate();
        Category::truncate();
        CompleteRequest::truncate();
        ContactMessage::truncate();
        Counter::truncate();
        CustomPage::truncate();
        Faq::truncate();
        FooterLink::truncate();
        FooterSocialLink::truncate();
        HowItWork::truncate();
        Message::truncate();
        MessageDocument::truncate();
        Order::truncate();
        Partner::truncate();
        PopularPost::truncate();
        ProviderWithdraw::truncate();
        RefundRequest::truncate();
        Review::truncate();
        Schedule::truncate();
        Service::truncate();
        Subscriber::truncate();
        Testimonial::truncate();
        Ticket::truncate();
        TicketMessage::truncate();
        User::truncate();
        WithdrawMethod::truncate();


        // pending ----
        $admins = Admin::where('id', '!=', 1)->get();
        foreach($admins as $admin){
            $admin_image = $admin->image;
            $admin->delete();
            if($admin_image){
                if(File::exists(public_path().'/'.$admin_image))unlink(public_path().'/'.$admin_image);
            }
        }


        $folderPath = public_path('uploads/custom-images');
        $response = File::deleteDirectory($folderPath);

        $path = public_path('uploads/custom-images');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        $notification = trans('admin_validation.Database Cleared Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function index(){
        $setting = Setting::first();
        $cookieConsent = CookieConsent::first();
        $googleRecaptcha = GoogleRecaptcha::first();
        $facebookComment = FacebookComment::first();
        $tawkChat = TawkChat::first();
        $googleAnalytic = GoogleAnalytic::first();
        $customPaginations = CustomPagination::all();
        $socialLogin = SocialLoginInformation::first();
        $facebookPixel = FacebookPixel::first();
        $pusher = PusherCredentail::first();
        $currencies = Currency::orderBy('name','asc')->get();
        $selected_theme = $setting->selected_theme;

        return view('admin.setting',compact('setting','cookieConsent','googleRecaptcha','facebookComment','tawkChat','googleAnalytic','customPaginations','socialLogin','facebookPixel','currencies','pusher','selected_theme'));
    }

    public function updateThemeColor(Request $request){
        $setting = Setting::first();
        $setting->theme_one_color = $request->theme_one_color;
        $setting->theme_two_color = $request->theme_two_color;
        $setting->theme_three_color = $request->theme_three_color;
        $setting->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function updateCustomPagination(Request $request){

        foreach($request->quantities as $index => $quantity){
            if($request->quantities[$index]==''){
                $notification=array(
                    'messege'=> trans('admin_validation.Every field is required'),
                    'alert-type'=>'error'
                );

                return redirect()->back()->with($notification);
            }

            $customPagination=CustomPagination::find($request->ids[$index]);
            $customPagination->qty=$request->quantities[$index];
            $customPagination->save();
        }

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function updateGeneralSetting(Request $request){
        $rules = [
            'layout' => 'required',
            'lg_header' => 'required',
            'sm_header' => 'required',
            'currency_name' => 'required',
            'currency_icon' => 'required',
            'timezone' => 'required',
            'selected_theme' => 'required',
        ];
        $customMessages = [
            'layout.required' => trans('admin_validation.Layout is required'),
            'lg_header.required' => trans('admin_validation.Sidebar large header is required'),
            'sm_header.required' => trans('admin_validation.Sidebar small header is required'),
            'currency_name.required' => trans('admin_validation.Currency name is required'),
            'currency_icon.required' => trans('admin_validation.Currency icon is required'),
            'timezone.required' => trans('admin_validation.Timezone is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $setting = Setting::first();
        $setting->selected_theme = $request->selected_theme;
        $setting->text_direction = $request->layout;
        $setting->sidebar_lg_header = $request->lg_header;
        $setting->sidebar_sm_header = $request->sm_header;
        $setting->currency_name = $request->currency_name;
        $setting->currency_icon = $request->currency_icon;
        $setting->currency_position = $request->currency_position;
        $setting->timezone = $request->timezone;
        $setting->show_provider_contact_info  = $request->show_provider_contact_info ;
        $setting->commission_type  = $request->commission_type ;
        $setting->live_chat  = $request->live_chat ;
        $setting->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function updateCookieConset(Request $request){
        $rules = [
            'allow' => 'required',
            'border' => 'required',
            'corners' => 'required',
            'background_color' => 'required',
            'text_color' => 'required',
            'border_color' => 'required',
            'button_color' => 'required',
            'btn_text_color' => 'required',
            'link_text' => 'required',
            'btn_text' => 'required',
            'message' => 'required',
        ];
        $customMessages = [
            'allow.required' => trans('admin_validation.Allow is required'),
            'border.required' => trans('admin_validation.Border is required'),
            'corners.required' => trans('admin_validation.Corner is required'),
            'background_color.required' => trans('admin_validation.Background color is required'),
            'text_color.required' => trans('admin_validation.Text color is required'),
            'border_color.required' => trans('admin_validation.Border Color is required'),
            'button_color.required' => trans('admin_validation.Button color is required'),
            'btn_text_color.required' => trans('admin_validation.Button text color is required'),
            'link_text.required' => trans('admin_validation.Link text is required'),
            'btn_text.required' => trans('admin_validation.Button text is required'),
            'message.required' => trans('admin_validation.Message is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $cookieConsent = CookieConsent::first();
        $cookieConsent->status = $request->allow;
        $cookieConsent->border = $request->border;
        $cookieConsent->corners = $request->corners;
        $cookieConsent->background_color = $request->background_color;
        $cookieConsent->text_color = $request->text_color;
        $cookieConsent->border_color = $request->border_color;
        $cookieConsent->btn_bg_color = $request->button_color;
        $cookieConsent->btn_text_color = $request->btn_text_color;
        $cookieConsent->link_text = $request->link_text;
        $cookieConsent->btn_text = $request->btn_text;
        $cookieConsent->message = $request->message;
        $cookieConsent->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function updateFacebookComment(Request $request){
        $rules = [
            'comment_type' => 'required',
            'app_id' => $request->comment_type == 0 ?  'required' : ''
        ];
        $customMessages = [
            'app_id.required' => trans('admin_validation.App id is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $facebookComment = FacebookComment::first();
        $facebookComment->comment_type = $request->comment_type;
        $facebookComment->app_id = $request->app_id;
        $facebookComment->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function updateTawkChat(Request $request){
        $rules = [
            'allow' => 'required',
            'chat_link' => $request->allow == 1 ?  'required' : ''
        ];
        $customMessages = [
            'allow.required' => trans('admin_validation.Allow is required'),
            'chat_link.required' => trans('admin_validation.Chat link is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $tawkChat = TawkChat::first();
        $tawkChat->status = $request->allow;
        $tawkChat->chat_link = $request->chat_link;
        $tawkChat->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function updateGoogleAnalytic(Request $request){
        $rules = [
            'allow' => 'required',
            'analytic_id' => $request->allow == 1 ?  'required' : ''
        ];
        $customMessages = [
            'allow.required' => trans('admin_validation.Allow is required'),
            'analytic_id.required' => trans('admin_validation.Analytic id is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $googleAnalytic = GoogleAnalytic::first();
        $googleAnalytic->status = $request->allow;
        $googleAnalytic->analytic_id = $request->analytic_id;
        $googleAnalytic->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function updateGoogleRecaptcha(Request $request){

        $rules = [
            'site_key' => $request->allow == 1 ?  'required' : '',
            'secret_key' => $request->allow == 1 ?  'required' : '',
            'allow' => 'required',
        ];
        $customMessages = [
            'site_key.required' => trans('admin_validation.Site key is required'),
            'secret_key.required' => trans('admin_validation.Secret key is required'),
            'allow.required' => trans('admin_validation.Allow is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $googleRecaptcha = GoogleRecaptcha::first();
        $googleRecaptcha->status = $request->allow;
        $googleRecaptcha->site_key = $request->site_key;
        $googleRecaptcha->secret_key = $request->secret_key;
        $googleRecaptcha->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function updateLogoFavicon(Request $request){
        $setting = Setting::first();
        if($request->logo){
            $old_logo=$setting->logo;
            $image=$request->logo;
            $ext=$image->getClientOriginalExtension();
            $logo_name= 'logo-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $logo_name='uploads/website-images/'.$logo_name;
            $logo=Image::make($image)
                    ->save(public_path().'/'.$logo_name);
            $setting->logo=$logo_name;
            $setting->save();
            if($old_logo){
                if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
            }
        }

        if($request->footer_logo){
            $old_logo=$setting->footer_logo;
            $image=$request->footer_logo;
            $ext=$image->getClientOriginalExtension();
            $logo_name= 'logo-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $logo_name='uploads/website-images/'.$logo_name;
            $logo=Image::make($image)
                    ->save(public_path().'/'.$logo_name);
            $setting->footer_logo=$logo_name;
            $setting->save();
            if($old_logo){
                if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
            }
        }



        if($request->favicon){
            $old_favicon=$setting->favicon;
            $favicon=$request->favicon;
            $ext=$favicon->getClientOriginalExtension();
            $favicon_name= 'favicon-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $favicon_name='uploads/website-images/'.$favicon_name;
            Image::make($favicon)
                    ->save(public_path().'/'.$favicon_name);
            $setting->favicon=$favicon_name;
            $setting->save();
            if($old_favicon){
                if(File::exists(public_path().'/'.$old_favicon))unlink(public_path().'/'.$old_favicon);
            }
        }

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function showClearDatabasePage(){
        return view('admin.clear_database');
    }




    public function updateSocialLogin(Request $request){

        $rules = [
            'facebook_app_id' => $request->allow_facebook_login ?  'required' : '',
            'facebook_app_secret' => $request->allow_facebook_login ?  'required' : '',
            'gmail_client_id' => $request->allow_gmail_login ?  'required' : '',
            'gmail_secret_id' => $request->allow_gmail_login ?  'required' : '',
            'gmail_redirect_url' => $request->allow_gmail_login ?  'required' : '',
            'facebook_redirect_url' => $request->allow_gmail_login ?  'required' : '',
        ];
        $customMessages = [
            'facebook_app_id.required' => trans('admin_validation.Facebook app id is required'),
            'facebook_app_secret.required' => trans('admin_validation.Facebook app secret is required'),
            'gmail_client_id.required' => trans('admin_validation.Gmail client id is required'),
            'gmail_secret_id.required' => trans('admin_validation.Gmail secret id is required'),
            'gmail_redirect_url.required' => trans('admin_validation.Gmail redirect url is required'),
            'facebook_redirect_url.required' => trans('admin_validation.Facebook redirect url is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $socialLogin = SocialLoginInformation::first();
        $socialLogin->is_facebook = $request->allow_facebook_login ? 1 : 0;
        $socialLogin->facebook_client_id = $request->facebook_app_id;
        $socialLogin->facebook_secret_id = $request->facebook_app_secret;
        $socialLogin->facebook_redirect_url = $request->facebook_redirect_url;
        $socialLogin->is_gmail = $request->allow_gmail_login ? 1 : 0;
        $socialLogin->gmail_client_id = $request->gmail_client_id;
        $socialLogin->gmail_secret_id = $request->gmail_secret_id;
        $socialLogin->gmail_redirect_url = $request->gmail_redirect_url;
        $socialLogin->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function updateFacebookPixel(Request $request){

        $rules = [
            'app_id' => $request->allow_facebook_pixel ?  'required' : '',
        ];
        $customMessages = [
            'app_id.required' => trans('admin_validation.App id is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $facebookPixel = FacebookPixel::first();
        $facebookPixel->app_id = $request->app_id;
        $facebookPixel->status = $request->allow_facebook_pixel ? 1 : 0;
        $facebookPixel->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function updatePusher(Request $request){
        $rules = [
            'app_id' => 'required',
            'app_key' => 'required',
            'app_secret' => 'required',
            'app_cluster' => 'required',
        ];
        $customMessages = [
            'app_id.required' => trans('admin_validation.App id is required'),
            'app_key.required' => trans('admin_validation.App key is required'),
            'app_secret.required' => trans('admin_validation.App secret is required'),
            'app_cluster.required' => trans('admin_validation.App cluster is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $pusher = PusherCredentail::first();
        $pusher->app_id = $request->app_id;
        $pusher->app_key = $request->app_key;
        $pusher->app_secret = $request->app_secret;
        $pusher->app_cluster = $request->app_cluster;
        $pusher->save();

        Artisan::call("env:set PUSHER_APP_ID='". $request->app_id ."'");
        Artisan::call("env:set PUSHER_APP_KEY='". $request->app_key ."'");
        Artisan::call("env:set PUSHER_APP_SECRET='". $request->app_secret ."'");
        Artisan::call("env:set PUSHER_APP_CLUSTER='". $request->app_cluster ."'");


        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function update_database(){
        Artisan::call('migrate');
        Artisan::call('optimize:clear');

        $setting = Setting::first();
        $setting->app_version = 'Version : 2.1';
        $setting->save();

        $notification = trans('admin_validation.Database updated successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }
}
