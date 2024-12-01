<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;
use App\Models\City;
use App\Models\Category;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Counter;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\AboutUs;
use App\Models\HowItWork;
use App\Models\BreadcrumbImage;
use App\Models\ContactPage;
use App\Models\GoogleRecaptcha;
use App\Models\ContactMessage;
use App\Models\EmailTemplate;
use App\Models\CustomPagination;
use App\Models\PopularPost;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Faq;
use App\Models\TermsAndCondition;
use App\Models\CustomPage;
use App\Models\Partner;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Review;
use App\Models\Order;
use App\Models\AdditionalService;
use App\Models\SectionContent;
use App\Models\SectionControl;
use App\Models\Subscriber;
use App\Models\SeoSetting;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\FacebookComment;
use App\Models\AppointmentSchedule;
use App\Models\MobileSlider;


use App\Rules\Captcha;
use App\Mail\ContactMessageInformation;
use App\Mail\SubscriptionVerification;
use App\Mail\UserRegistration;
use App\Helpers\MailHelper;
use Mail;
use Session;
use Str;
use Auth;
use Hash;
use Image;

use App\Models\StripePayment;
use App\Models\PaypalPayment;
use App\Models\RazorpayPayment;
use App\Models\Flutterwave;
use App\Models\PaystackAndMollie;
use App\Models\InstamojoPayment;
use App\Models\PaymongoPayment;
use App\Models\BankPayment;
use App\Models\PusherCredentail;

class HomeController extends Controller
{
    public function website_setup(){
        $bankPayment = BankPayment::select('id','status','account_info','image')->first();
        $stripe = StripePayment::first();
        $paypal = PaypalPayment::first();
        $razorpay = RazorpayPayment::first();
        $flutterwave = Flutterwave::first();
        $mollie = PaystackAndMollie::first();
        $pusher_credentail = PusherCredentail::first();
        $paystack = $mollie;
        $instamojoPayment = InstamojoPayment::first();

        $setting = Setting::select('id','logo','favicon','text_direction','timezone','topbar_phone','topbar_email','opening_time','currency_name','currency_icon','login_image','selected_theme','theme_one_color','theme_two_color','theme_three_color','default_avatar')->first();
        
        return response()->json([
            'pusher_credentail' => $pusher_credentail,
            'setting' => $setting,
            'bankPayment' => $bankPayment,
            'stripe' => $stripe,
            'paypal' => $paypal,
            'razorpay' => $razorpay,
            'flutterwave' => $flutterwave,
            'mollie' => $mollie,
            'instamojoPayment' => $instamojoPayment,
            'paystack' => $paystack,
        ]);
    }
    public function index(Request $request)
    {

        $setting = Setting::select('selected_theme')->first();

        $contents = SectionContent::all();
        $control = SectionControl::get();
        $setting = Setting::first();
        $seo_setting = SeoSetting::where('id', 1)->first();

        // intro section start

        $intro_visibility = false;
        $intro = $control->where('id', 1)->first();
        if($intro->status == 1) $intro_visibility = true;

        $intro_section = Slider::select('title','description','image','header_one','header_two','total_service_sold','home2_image','home3_image','popular_tag')->first();

        $service_areas = City::orderBy('name','asc')->select('id','name','slug')->where('status',1)->get();
        $popular_tag = json_decode($intro_section->popular_tag);
        $mobile_sliders = MobileSlider::OrderBy('serial','asc')->get();
        // intro section end

        // category section start

        $category_control = $control->where('id', 2)->first();
        $category_visibility = false;
        if($category_control->status == 1){
            $category_visibility = true;
        }

        $category_content = $contents->where('id', 1)->first();
        $category_section = (object) array(
            'visibility' => $category_visibility,
            'title' => $category_content->title,
            'description' => $category_content->description,
        );

        $search_categories = Category::orderBy('name','asc')->select('id','name','slug','icon','image')->where('status',1)->get();
        $categories = Category::orderBy('name','asc')->select('id','name','slug','icon','image')->where('status',1)->get()->take($category_control->qty);

        // category section end

        // featured section start

        $featured_control = $control->where('id', 3)->first();
        $featured_section_visibility = false;
        if($featured_control->status == 1){
            $featured_section_visibility = true;
        }

        $featured_service_content = $contents->where('id', 2)->first();
        $featured_service_section = (object) array(
            'visibility' => $featured_section_visibility,
            'title' => $featured_service_content->title,
            'description' => $featured_service_content->description,
        );

        $featured_services = Service::with('category','provider')->where(['approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0, 'make_featured' => 1])->orderBy('id','desc')->select('id','name','slug','image','price','category_id','provider_id','make_featured','is_banned','status','approve_by_admin')->get()->take($featured_control->qty);

        // featured section end

        // coundown section start

        $coundown_visibility = false;
        $coundown_control = $control->where('id', 4)->first();
        if($coundown_control->status == 1){
            $coundown_visibility = true;
        }

        $counters = Counter::select('id','title','icon','number','status')->where('status',1)->get()->take($coundown_control->qty);

        $counter_bg_image = array('image' => $setting->counter_bg_image);
        $counter_bg_image = (object) $counter_bg_image;

        // coundown section end

        // popular section start

        $popular_control = $control->where('id', 5)->first();
        $popular_section_visibility = false;
        if($popular_control->status == 1){
            $popular_section_visibility = true;
        }

        $popular_service_content = $contents->where('id', 3)->first();
        $popular_service_section = (object) array(
            'visibility' => $popular_section_visibility,
            'title' => $popular_service_content->title,
            'description' => $popular_service_content->description,
        );

        $popular_services = Service::with('category','provider')->where(['approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0, 'make_popular' => 1])->orderBy('id','desc')->select('id','name','slug','image','price','category_id','provider_id','make_popular','is_banned','status','approve_by_admin')->get()->take($popular_control->qty);

        // popular section end

        $currency_icon = array('icon' => $setting->currency_icon);
        $currency_icon = (object) $currency_icon;

         // join as provider section start

         $join_as_provider_visibility = false;
         $provider_control = $control->where('id', 6)->first();
         if($provider_control->status == 1){
             $join_as_provider_visibility = true;
         }

         $join_as_a_provider = array(
            'image' => $setting->join_as_a_provider_banner,
            'home2_image' => $setting->home2_join_as_provider,
            'home3_image' => $setting->home3_join_as_provider,
            'title' => $setting->join_as_a_provider_title,
            'button_text' => $setting->join_as_a_provider_btn,
        );
        $join_as_a_provider = (object) $join_as_a_provider;

         // join as provider section end

        //mobile section start

        $mobile_app_section_visbility = false;
        $app_control = $control->where('id', 7)->first();
        if($app_control->status == 1){
            $mobile_app_section_visbility = true;
        }

        $mobile_app = array(
            'short_title' => $setting->app_short_title,
            'full_title' => $setting->app_full_title,
            'description' => $setting->app_description,
            'play_store' => $setting->google_playstore_link,
            'app_store' => $setting->app_store_link,
            'image' => $setting->app_image,
            'home2_app_image' => $setting->home2_app_image,
            'home3_app_image' => $setting->home3_app_image,
        );
        $mobile_app = (object) $mobile_app;

        // mobile  section end

        // testimonial section start
        $testimonial_control = $control->where('id', 8)->first();
        $testimonial_visibility = false;
        if($testimonial_control->status == 1){
            $testimonial_visibility = true;
        }

        $testimonial_content = $contents->where('id', 4)->first();
        $testimonial_section = (object) array(
            'visibility' => $testimonial_visibility,
            'title' => $testimonial_content->title,
            'description' => $testimonial_content->description,
        );

        $testimonials = Testimonial::select('id','name','image','designation','comment','status')->where('status',1)->get()->take($testimonial_control->qty);

        // testimonial section end

        // blog section start

        $blog_control = $control->where('id', 9)->first();
        $blog_visibility = false;
        if($blog_control->status == 1){
            $blog_visibility = true;
        }

        $blog_content = $contents->where('id', 5)->first();
        $blog_section = (object) array(
            'visibility' => $blog_visibility,
            'title' => $blog_content->title,
            'description' => $blog_content->description,
        );

        $blogs = Blog::select('id','title','image','slug','status','show_homepage')->where(['status' => 1, 'show_homepage' => 1])->orderBy('id','desc')->get()->take($blog_control->qty);

        // blog section end

        // subscribe section start

        $subscription_visbility = false;
        $subscription_control = $control->where('id', 10)->first();
        if($subscription_control->status == 1){
            $subscription_visbility = true;
        }

        $subscriber = array(
            'title' => $setting->subscriber_title,
            'description' => $setting->subscriber_description,
            'foreground_image' => $setting->subscriber_image,
            'background_image' => $setting->subscription_bg,
            'home2_background_image' => $setting->home2_subscription_bg,
            'home3_background_image' => $setting->home3_subscription_bg,
        );
        $subscriber = (object) $subscriber;

        // subscribe section end

        // partner start
        $partner_visbility = false;
        $partner_control = $control->where('id', 22)->first();
        if($partner_control->status == 1){
            $partner_visbility = true;
        }

        $partners = Partner::where(['status' => 1])->get()->take($partner_control->qty);

        // parnter end

        // contact start

        $contact_visbility = false;
        $contact_control = $control->where('id', 21)->first();
        if($contact_control->status == 1){
            $contact_visbility = true;
        }

        $contact = (object) array(
            'foreground' => $setting->home2_contact_foreground,
            'background' => $setting->home2_contact_background,
            'call_as_now' => $setting->home2_contact_call_as,
            'phone' => $setting->home2_contact_phone,
            'available_time' => $setting->home2_contact_available,
            'form_title' => $setting->home2_contact_form_title,
            'form_description' => $setting->home2_contact_form_description,
        );

        // contact end

        $recaptchaSetting = GoogleRecaptcha::first();

        // start how it work

        $work_visbility = false;
        $work_control = $control->where('id', 33)->first();
        if($work_control->status == 1){
            $work_visbility = true;
        }

        $how_it_work = (object) array(
            'background' => $setting->how_it_work_background,
            'foreground' => $setting->how_it_work_foreground,
            'title' => $setting->how_it_work_title,
            'description' => $setting->how_it_work_description,
            'items' => json_decode($setting->how_it_work_items),
        );

        // end how it work

        return response()->json([
            'seo_setting' => $seo_setting,
            'intro_visibility' => $intro_visibility,
            'intro_section' => $intro_section,
            'mobile_sliders' => $mobile_sliders,
            'popular_tag' => $popular_tag,
            'search_categories' => $search_categories,
            'service_areas' => $service_areas,
            'category_section' => $category_section,
            'categories' => $categories,
            'featured_service_section' => $featured_service_section,
            'featured_services' => $featured_services,
            'currency_icon' => $currency_icon,
            'contact_visbility' => $contact_visbility,
            'contact_section' => $contact,
            'recaptchaSetting' => $recaptchaSetting,
            'coundown_visibility' => $coundown_visibility,
            'counter_bg_image' => $counter_bg_image,
            'counters' => $counters,
            'popular_service_section' => $popular_service_section,
            'popular_services' => $popular_services,
            'join_as_provider_visibility' => $join_as_provider_visibility,
            'join_as_a_provider' => $join_as_a_provider,
            'mobile_app_section_visbility' => $mobile_app_section_visbility,
            'mobile_app' => $mobile_app,
            'testimonial_section' => $testimonial_section,
            'testimonials' => $testimonials,
            'blog_section' => $blog_section,
            'blogs' => $blogs,
            'subscription_visbility' => $subscription_visbility,
            'subscriber' => $subscriber,
            'partner_visbility' => $partner_visbility,
            'partners' => $partners,
        ]);

        $selected_theme = Session::get('selected_theme');
        if ($selected_theme == 'theme_one'){
            return view('index')->with([
                'seo_setting' => $seo_setting,
                'intro_visibility' => $intro_visibility,
                'intro_section' => $intro_section,
                'popular_tag' => $popular_tag,
                'search_categories' => $search_categories,
                'service_areas' => $service_areas,
                'category_section' => $category_section,
                'categories' => $categories,
                'featured_service_section' => $featured_service_section,
                'featured_services' => $featured_services,
                'currency_icon' => $currency_icon,
                'coundown_visibility' => $coundown_visibility,
                'counter_bg_image' => $counter_bg_image,
                'counters' => $counters,
                'popular_service_section' => $popular_service_section,
                'popular_services' => $popular_services,
                'join_as_provider_visibility' => $join_as_provider_visibility,
                'join_as_a_provider' => $join_as_a_provider,
                'mobile_app_section_visbility' => $mobile_app_section_visbility,
                'mobile_app' => $mobile_app,
                'testimonial_section' => $testimonial_section,
                'testimonials' => $testimonials,
                'blog_section' => $blog_section,
                'blogs' => $blogs,
                'subscription_visbility' => $subscription_visbility,
                'subscriber' => $subscriber,
            ]);
        }elseif($selected_theme == 'theme_two'){
            return view('index2')->with([
                'seo_setting' => $seo_setting,
                'intro_visibility' => $intro_visibility,
                'intro_section' => $intro_section,
                'popular_tag' => $popular_tag,
                'search_categories' => $search_categories,
                'service_areas' => $service_areas,
                'category_section' => $category_section,
                'categories' => $categories,
                'featured_service_section' => $featured_service_section,
                'featured_services' => $featured_services,
                'currency_icon' => $currency_icon,
                'contact_visbility' => $contact_visbility,
                'contact_section' => $contact,
                'recaptchaSetting' => $recaptchaSetting,
                'coundown_visibility' => $coundown_visibility,
                'counter_bg_image' => $counter_bg_image,
                'counters' => $counters,
                'popular_service_section' => $popular_service_section,
                'popular_services' => $popular_services,
                'join_as_provider_visibility' => $join_as_provider_visibility,
                'join_as_a_provider' => $join_as_a_provider,
                'mobile_app_section_visbility' => $mobile_app_section_visbility,
                'mobile_app' => $mobile_app,
                'testimonial_section' => $testimonial_section,
                'testimonials' => $testimonials,
                'blog_section' => $blog_section,
                'blogs' => $blogs,
                'subscription_visbility' => $subscription_visbility,
                'subscriber' => $subscriber,
                'partner_visbility' => $partner_visbility,
                'partners' => $partners,
            ]);
        }elseif($selected_theme == 'theme_three'){
            return view('index3')->with([
                'seo_setting' => $seo_setting,
                'intro_visibility' => $intro_visibility,
                'intro_section' => $intro_section,
                'popular_tag' => $popular_tag,
                'partner_visbility' => $partner_visbility,
                'partners' => $partners,
                'search_categories' => $search_categories,
                'service_areas' => $service_areas,
                'category_section' => $category_section,
                'categories' => $categories,
                'featured_service_section' => $featured_service_section,
                'featured_services' => $featured_services,
                'currency_icon' => $currency_icon,
                'coundown_visibility' => $coundown_visibility,
                'counter_bg_image' => $counter_bg_image,
                'counters' => $counters,
                'popular_service_section' => $popular_service_section,
                'popular_services' => $popular_services,
                'work_visbility' => $work_visbility,
                'how_it_work' => $how_it_work,
                'join_as_provider_visibility' => $join_as_provider_visibility,
                'join_as_a_provider' => $join_as_a_provider,
                'mobile_app_section_visbility' => $mobile_app_section_visbility,
                'mobile_app' => $mobile_app,
                'testimonial_section' => $testimonial_section,
                'testimonials' => $testimonials,
                'blog_section' => $blog_section,
                'blogs' => $blogs,
                'subscription_visbility' => $subscription_visbility,
                'subscriber' => $subscriber,
            ]);
        }else{
            return view('index')->with([
                'seo_setting' => $seo_setting,
                'intro_visibility' => $intro_visibility,
                'intro_section' => $intro_section,
                'popular_tag' => $popular_tag,
                'search_categories' => $search_categories,
                'service_areas' => $service_areas,
                'category_section' => $category_section,
                'categories' => $categories,
                'featured_service_section' => $featured_service_section,
                'featured_services' => $featured_services,
                'currency_icon' => $currency_icon,
                'coundown_visibility' => $coundown_visibility,
                'counter_bg_image' => $counter_bg_image,
                'counters' => $counters,
                'popular_service_section' => $popular_service_section,
                'popular_services' => $popular_services,
                'join_as_provider_visibility' => $join_as_provider_visibility,
                'join_as_a_provider' => $join_as_a_provider,
                'mobile_app_section_visbility' => $mobile_app_section_visbility,
                'mobile_app' => $mobile_app,
                'testimonial_section' => $testimonial_section,
                'testimonials' => $testimonials,
                'blog_section' => $blog_section,
                'blogs' => $blogs,
                'subscription_visbility' => $subscription_visbility,
                'subscriber' => $subscriber,
            ]);
        }
    }

    public function join_as_a_provider (){

        $breadcrumb = BreadcrumbImage::where(['id' => 12])->first();
        $countries = Country::where('status',1)->orderBy('name','asc')->get();
        $recaptchaSetting = GoogleRecaptcha::first();

        return response()->json([
            'breadcrumb' => $breadcrumb,
            'countries' => $countries,
            'recaptchaSetting' => $recaptchaSetting,
        ]);

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

        return view('join_as_a_provider')->with([
            'active_theme' => $active_theme,
            'breadcrumb' => $breadcrumb,
            'countries' => $countries,
            'recaptchaSetting' => $recaptchaSetting,
        ]);
    }


    public function checkUserName(Request $request){

        $rules = [
            'username'=>'required',
        ];
        $customMessages = [
            'username.required' => trans('user_validation.Username is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = User::where('user_name',$request->username)->count();

        if($user== 0){
            return response()->json(['status' => 1, 'message' => trans('user_validation.Username available. you can use it')]);
        }else{
            return response()->json(['status' => 0, 'message' => trans('user_validation.User name already exist')],403);
        }
    }

    public function stateByCountry($id){

        $states = CountryState::where(['status' => 1, 'country_id' => $id])->orderBy('name','asc')->get();

        return response()->json(['states'=>$states]);
    }

    public function cityByState($id){
        $cities = City::where(['status' => 1, 'country_state_id' => $id])->orderBy('name','asc')->get();

        return response()->json(['cities'=>$cities]);
    }


    public function request_provider(Request $request){
        $rules = [
            'name'=>'required',
            'username'=>'required|unique:users,user_name',
            'email'=>'required',
            'phone'=>'required',
            'designation'=>'required',
            'country'=>'required',
            'state'=>'required',
            'service_area'=>'required',
            'address'=>'required',
            'password'=>'required|confirmed|min:4',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'username.required' => trans('user_validation.User name is required'),
            'username.unique' => trans('user_validation.User name alreay exist'),
            'email.required' => trans('user_validation.Email is required'),
            'email.unique' => trans('user_validation.Email already exist'),
            'phone.required' => trans('user_validation.Phone is required'),
            'country.required' => trans('user_validation.Country or region is required'),
            'state.required' => trans('user_validation.State or province is required'),
            'service_area.required' => trans('user_validation.Service area is required'),
            'designation.required' => trans('user_validation.Desgination is required'),
            'address.required' => trans('user_validation.Address is required'),
            'password.required' => trans('user_validation.Password is required'),
            'password.min' => trans('user_validation.Password must be 4 characters'),
            'password.confirmed' => trans('user_validation.Confrim password does not match'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_name = $request->username;
        $user->phone = $request->phone;
        $user->designation = $request->designation;
        $user->address = $request->address;
        $user->country_id = $request->country;
        $user->state_id = $request->state;
        $user->city_id = $request->service_area;
        $user->is_provider = 1;
        $user->password = Hash::make($request->password);
        $user->verify_token = Str::random(100);
        $user->save();

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
        }

        MailHelper::setMailConfig();

        $template=EmailTemplate::where('id',4)->first();
        $subject=$template->subject;
        $message=$template->description;
        $message = str_replace('{{user_name}}',$request->name,$message);
        Mail::to($user->email)->send(new UserRegistration($message,$subject,$user));

        $notification = trans('user_validation.Register Successfully. Please Verify your email');
        return response()->json(['status' => 1, 'message' => $notification]);
    }

    public function aboutUs(){

        $contents = SectionContent::all();
        $control = SectionControl::get();

        $seo_setting = SeoSetting::where('id', 2)->first();

        // start work section

        $work_visbility = false;
        $work_control = $control->where('id', 35)->first();
        if($work_control->status == 1){
            $work_visbility = true;
        }

        $about = AboutUs::first();
        $how_it_works = HowItWork::all();
        $how_it_work_title = $about->header;
        $how_it_work_descritpion = $about->header_description;

        // work section end

        // about us start

        $about_visbility = false;
        $work_control = $control->where('id', 36)->first();
        if($work_control->status == 1){
            $about_visbility = true;
        }

        $about_us_section = (object) array(
            'about_us_title' => $about->about_us_title,
            'about_us' => $about->about_us,
            'foreground_image' => $about->foreground_image,
            'background_image' => $about->background_image,
            'client_image_one' => $about->small_image_one,
            'client_image_two' => $about->small_image_two,
            'client_image_three' => $about->small_image_three,
            'total_rating' => $about->total_rating,
        );

        // about us end

        // start why choose us

        $why_choose_visibility = false;
        $why_choose_control = $control->where('id', 38)->first();
        if($why_choose_control->status == 1){
            $why_choose_visibility = true;
        }

        $why_choose_us = (object) array(
            'why_choose_us_title' => $about->why_choose_us_title,
            'why_choose_desciption' => $about->why_choose_desciption,
            'background_image' => $about->why_choose_background,
            'foreground_image' => $about->why_choose_foreground,
            'item_one' => $about->title_one,
            'item_two' => $about->title_two,
            'item_three' => $about->title_three,
            'description_one' => $about->description_one,
            'description_two' => $about->description_two,
            'description_three' => $about->description_three,
        );

        // end why choose us

        $breadcrumb = BreadcrumbImage::where(['id' => 1])->first();

        // start coundwon
        $coundown_visibility = false;
        $coundown_control = $control->where('id', 37)->first();
        if($coundown_control->status == 1){
            $coundown_visibility = true;
        }

        $counters = Counter::select('id','title','icon','number','status')->where('status',1)->get()->take($coundown_control->qty);

        $setting = Setting::first();
        $counter_bg_image = (object) array('image' => $setting->counter_bg_image);

        // end cowndown

        // start provider

        $join_as_provider_visibility = false;
         $provider_control = $control->where('id', 39)->first();
         if($provider_control->status == 1){
             $join_as_provider_visibility = true;
         }

        $join_as_a_provider = (object) array(
            'image' => $setting->join_as_a_provider_banner,
            'title' => $setting->join_as_a_provider_title,
            'button_text' => $setting->join_as_a_provider_btn,
        );

        // end provider

        // testimonial section start
        $testimonial_control = $control->where('id', 40)->first();
        $testimonial_visibility = false;
        if($testimonial_control->status == 1){
            $testimonial_visibility = true;
        }

        $testimonial_content = $contents->where('id', 4)->first();
        $testimonial_section = (object) array(
            'visibility' => $testimonial_visibility,
            'title' => $testimonial_content->title,
            'description' => $testimonial_content->description,
        );

        $testimonials = Testimonial::select('id','name','image','designation','comment','status')->where('status',1)->get()->take($testimonial_control->qty);

        // end testimonial


        return response()->json([
            'seo_setting' => $seo_setting,
            'breadcrumb' => $breadcrumb,
            'work_visbility' => $work_visbility,
            'how_it_work_title' => $how_it_work_title,
            'how_it_work_descritpion' => $how_it_work_descritpion,
            'how_it_works' => $how_it_works,
            'about_visbility' => $about_visbility,
            'about_us_section' => $about_us_section,
            'coundown_visibility' => $coundown_visibility,
            'counters' => $counters,
            'counter_bg_image' => $counter_bg_image,
            'why_choose_visibility' => $why_choose_visibility,
            'why_choose_us' => $why_choose_us,
            'join_as_provider_visibility' => $join_as_provider_visibility,
            'join_as_a_provider' => $join_as_a_provider,
            'testimonial_section' => $testimonial_section,
            'testimonials' => $testimonials,
        ]);

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

        return view('about_us')->with([
            'active_theme' => $active_theme,
            'seo_setting' => $seo_setting,
            'breadcrumb' => $breadcrumb,
            'work_visbility' => $work_visbility,
            'how_it_work_title' => $how_it_work_title,
            'how_it_work_descritpion' => $how_it_work_descritpion,
            'how_it_works' => $how_it_works,
            'about_visbility' => $about_visbility,
            'about_us_section' => $about_us_section,
            'coundown_visibility' => $coundown_visibility,
            'counters' => $counters,
            'counter_bg_image' => $counter_bg_image,
            'why_choose_visibility' => $why_choose_visibility,
            'why_choose_us' => $why_choose_us,
            'join_as_provider_visibility' => $join_as_provider_visibility,
            'join_as_a_provider' => $join_as_a_provider,
            'testimonial_section' => $testimonial_section,
            'testimonials' => $testimonials,
        ]);
    }



    public function contactUs(){
        $contact = ContactPage::first();
        $breadcrumb = BreadcrumbImage::where(['id' => 2])->first();
        $recaptchaSetting = GoogleRecaptcha::first();

        $seo_setting = SeoSetting::where('id', 3)->first();

        return response()->json([
            'seo_setting' => $seo_setting,
            'breadcrumb' => $breadcrumb,
            'contact' => $contact,
            'recaptchaSetting' => $recaptchaSetting,
        ]);

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

        return view('contact_us')->with([
            'active_theme' => $active_theme,
            'seo_setting' => $seo_setting,
            'breadcrumb' => $breadcrumb,
            'contact' => $contact,
            'recaptchaSetting' => $recaptchaSetting,
        ]);
    }

    public function sendContactMessage(Request $request){
        $rules = [
            'name'=>'required',
            'email'=>'required',
            'subject'=>'required',
            'message'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'email.required' => trans('user_validation.Email is required'),
            'subject.required' => trans('user_validation.Subject is required'),
            'message.required' => trans('user_validation.Message is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $setting = Setting::first();
        if($setting->enable_save_contact_message == 1){
            $contact = new ContactMessage();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->phone = $request->phone;
            $contact->message = $request->message;
            $contact->save();
        }

        MailHelper::setMailConfig();
        $template = EmailTemplate::where('id',2)->first();
        $message = $template->description;
        $subject = $template->subject;
        $message = str_replace('{{name}}',$request->name,$message);
        $message = str_replace('{{email}}',$request->email,$message);
        $message = str_replace('{{phone}}',$request->phone,$message);
        $message = str_replace('{{subject}}',$request->subject,$message);
        $message = str_replace('{{message}}',$request->message,$message);

        Mail::to($setting->contact_email)->send(new ContactMessageInformation($message,$subject));

        $notification = trans('user_validation.Message send successfully');
        return response()->json(['message' => $notification]);
    }


    public function blogs(Request $request){
        $seo_setting = SeoSetting::where('id', 6)->first();

        $paginateQty = CustomPagination::whereId('1')->first()->qty;

        $blogs = Blog::select('id','title','image','slug','status')->where(['status' => 1])->orderBy('id','desc');

        if($request->search){
            $blogs = $blogs->where('title','LIKE','%'.$request->search.'%')
                            ->orWhere('description','LIKE','%'.$request->search.'%');
        }

        if($request->category){
            $category = BlogCategory::where('slug', $request->category)->first();
            $blogs = $blogs->where('blog_category_id', $category->id);
        }
        $blogs = $blogs->paginate($paginateQty);

        $breadcrumb = BreadcrumbImage::where(['id' => 3])->first();

        $popularBlogs = PopularPost::select('id','blog_id')->get();

        $popular_arr = array();
        foreach($popularBlogs as $popularBlog){
            $popular_arr[] = $popularBlog->blog_id;
        }

        $popular_blogs = Blog::select('id','title','image','slug','status','created_at')->where(['status' => 1])->orderBy('id','desc')->whereIn('id', $popular_arr)->get()->take(6);

        $categories = BlogCategory::where(['status' => 1])->orderBy('name','asc')->get();

        $setting = Setting::first();
        $subscriber = (object) array(
            'title' => $setting->subscriber_title,
            'description' => $setting->subscriber_description,
            'image' => $setting->blog_page_subscription_image,
        );

        return response()->json([
            'seo_setting' => $seo_setting,
            'breadcrumb' => $breadcrumb,
            'blogs' => $blogs,
            'popular_blogs' => $popular_blogs,
            'categories' => $categories,
            'subscriber' => $subscriber,
        ]);

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

        return view('blog')->with([
            'active_theme' => $active_theme,
            'seo_setting' => $seo_setting,
            'breadcrumb' => $breadcrumb,
            'blogs' => $blogs,
            'popular_blogs' => $popular_blogs,
            'categories' => $categories,
            'subscriber' => $subscriber,
        ]);
    }


    public function single_blog($slug){

        $breadcrumb = BreadcrumbImage::where(['id' => 3])->first();
        $blog = Blog::with('category')->where('slug', $slug)->first();
        $blog_pagiante_qty = CustomPagination::whereId('4')->first()->qty;
        $blog_comments = BlogComment::where(['blog_id' => $blog->id, 'status' => 1])->paginate($blog_pagiante_qty);

        $nextBlog = Blog::where('id', '>', $blog->id)->select('id','title','image','slug','status','created_at')->orderBy('id','asc')->where('status', 1)->first();
        $prevBlog = Blog::where('id', '<', $blog->id)->select('id','title','image','slug','status','created_at')->orderBy('id','desc')->where('status', 1)->first();

        $recaptchaSetting = GoogleRecaptcha::first();

        $popularBlogs = PopularPost::select('id','blog_id')->get();
        $popular_arr = array();
        foreach($popularBlogs as $popularBlog){
            $popular_arr[] = $popularBlog->blog_id;
        }
        $popular_blogs = Blog::select('id','title','image','slug','status','created_at')->where(['status' => 1])->orderBy('id','desc')->whereIn('id', $popular_arr)->where('id', '!=', $blog->id)->get()->take(6);

        $categories = BlogCategory::where(['status' => 1])->orderBy('name','asc')->get();

        $setting = Setting::first();
        $subscriber = (object) array(
            'title' => $setting->subscriber_title,
            'description' => $setting->subscriber_description,
            'image' => $setting->blog_page_subscription_image,
        );

        $facebookComment = FacebookComment::first();

        return response()->json([
            'breadcrumb' => $breadcrumb,
            'blog' => $blog,
            'nextBlog' => $nextBlog,
            'prevBlog' => $prevBlog,
            'blog_comments' => $blog_comments,
            'recaptchaSetting' => $recaptchaSetting,
            'popular_blogs' => $popular_blogs,
            'categories' => $categories,
            'subscriber' => $subscriber,
            'facebookComment' => $facebookComment,
        ]);

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

        $facebookComment = FacebookComment::first();

        return view('show_blog')->with([
            'active_theme' => $active_theme,
            'breadcrumb' => $breadcrumb,
            'blog' => $blog,
            'nextBlog' => $nextBlog,
            'prevBlog' => $prevBlog,
            'blog_comments' => $blog_comments,
            'recaptchaSetting' => $recaptchaSetting,
            'popular_blogs' => $popular_blogs,
            'categories' => $categories,
            'subscriber' => $subscriber,
            'facebookComment' => $facebookComment,
        ]);
    }

    public function blogComment(Request $request){
        $rules = [
            'name'=>'required',
            'email'=>'required',
            'comment'=>'required',
            'blog_id'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'email.required' => trans('user_validation.Email is required'),
            'comment.required' => trans('user_validation.Comment is required'),
            'blog_id.required' => trans('user_validation.Blog id is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $comment = new BlogComment();
        $comment->blog_id = $request->blog_id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->save();

        $notification = trans('user_validation.Blog comment submited successfully');

        return response()->json(['status' => 1, 'message' => $notification]);
    }

    public function faq(){
        $breadcrumb = BreadcrumbImage::where(['id' => 4])->first();
        $faqs = Faq::orderBy('id','desc')->where('status',1)->get();

        $recaptchaSetting = GoogleRecaptcha::first();

        return response()->json([
            'breadcrumb' => $breadcrumb,
            'faqs' => $faqs,
            'recaptchaSetting' => $recaptchaSetting,
        ]);

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

        return view('faq')->with([
            'active_theme' => $active_theme,
            'breadcrumb' => $breadcrumb,
            'faqs' => $faqs,
            'recaptchaSetting' => $recaptchaSetting,
        ]);
    }

    public function termsAndCondition(){
        $breadcrumb = BreadcrumbImage::where(['id' => 5])->first();
        $terms_conditions = TermsAndCondition::first();
        $terms_conditions = $terms_conditions->terms_and_condition;

        return response()->json([
            'breadcrumb' => $breadcrumb,
            'terms_conditions' => $terms_conditions,
        ]);

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

        return view('terms_and_conditions')->with([
            'active_theme' => $active_theme,
            'breadcrumb' => $breadcrumb,
            'terms_conditions' => $terms_conditions,
        ]);
    }

    public function privacyPolicy(){
        $breadcrumb = BreadcrumbImage::where(['id' => 6])->first();
        $privacyPolicy = TermsAndCondition::first();
        $privacyPolicy = $privacyPolicy->privacy_policy;

        return response()->json([
            'breadcrumb' => $breadcrumb,
            'privacyPolicy' => $privacyPolicy,
        ]);

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

        return view('privacy_policy')->with([
            'active_theme' => $active_theme,
            'breadcrumb' => $breadcrumb,
            'privacyPolicy' => $privacyPolicy,
        ]);
    }

    public function customPages(){
        $breadcrumb = BreadcrumbImage::where(['id' => 7])->first();
        $pages = CustomPage::where(['status' => 1])->get();

        return response()->json([
            'breadcrumb' => $breadcrumb,
            'pages' => $pages,
        ]);
    }

    public function customPage($slug){
        $breadcrumb = BreadcrumbImage::where(['id' => 7])->first();
        $page = CustomPage::where(['slug' => $slug, 'status' => 1])->first();

        return response()->json([
            'breadcrumb' => $breadcrumb,
            'page' => $page,
        ]);

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

        return view('custom_page')->with([
            'active_theme' => $active_theme,
            'breadcrumb' => $breadcrumb,
            'page' => $page
        ]);
    }



    public function services(Request $request){
        $seo_setting = SeoSetting::where('id', 5)->first();

        $breadcrumb = BreadcrumbImage::where(['id' => 8])->first();

        $service_areas = City::orderBy('name','asc')->select('id','name','slug')->where('status',1)->get();

        $categories = Category::orderBy('name','asc')->select('id','name','slug','icon')->where('status',1)->get();

        $service_pagiante_qty = CustomPagination::whereId('2')->first()->qty;
        $services = Service::with('category','provider')->where(['approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->select('id','name','slug','image','price','category_id','provider_id','is_banned','status','approve_by_admin');


        if($request->category){
            $category = Category::where('slug', $request->category)->first();
            if($category){
                $services = $services->where('category_id', $category->id);
            }
        }

        if($request->service_area){
            $services = $services->whereHas('provider', function($query) use ($request){
                $service_area = City::where('slug', $request->service_area)->first();
                if($service_area){
                    $query->where('city_id', $service_area->id);
                }
            });
        }

        if($request->price_range){
            if($request->price_range == 'low_price'){
                $services = $services->orderBy('price','asc');
            }elseif($request->price_range == 'high_price'){
                $services = $services->orderBy('price','desc');
            }else{
                $services = $services->orderBy('id','desc');
            }
        }

        if($request->rating){
            $services->when($request->rating, function ($query) use ($request) {
                $query->wherehas('activeReviews', function ($query) use ($request) {
                    $query->selectRaw('activeReviews.*, avg(rating) as average_rating')
                        ->groupBy('id')
                        ->havingRaw('average_rating = ?', [$request->rating]);
                 });
            });
        }

        if($request->others){
            if($request->others == 'asc'){
                $services = $services->orderBy('name','asc');
            }elseif($request->others == 'desc'){
                $services = $services->orderBy('name','desc');
            }
        }else{
            $services = $services->orderBy('id','desc');
        }

        if($request->service_type){
            if($request->service_type == 'featured'){
                $services = $services->where('make_featured', 1);
            }elseif($request->service_type == 'popular'){
                $services = $services->where('make_popular', 1);
            }
        }

        if($request->search){
            $services = $services->where(function ($query ) use ($request){
                                $query->where('name','LIKE','%'.$request->search.'%')
                                    ->orWhere('details','LIKE','%'.$request->search.'%');});
        }

        $services = $services->paginate($service_pagiante_qty);

        $setting = Setting::first();
        $currency_icon = (object) array('icon' => $setting->currency_icon);

        // partner start

        $partner_visbility = false;
        $partner_control = SectionControl::where('id', 41)->first();
        if($partner_control->status == 1){
            $partner_visbility = true;
        }
        $partners = Partner::where(['status' => 1])->get()->take($partner_control->qty);
        // end partner

        return response()->json([
            'seo_setting' => $seo_setting,
            'breadcrumb' => $breadcrumb,
            'service_areas' => $service_areas,
            'categories' => $categories,
            'services' => $services,
            'currency_icon' => $currency_icon,
            'partner_visbility' => $partner_visbility,
            'partners' => $partners,
        ]);

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

        return view('service')->with([
            'active_theme' => $active_theme,
            'seo_setting' => $seo_setting,
            'breadcrumb' => $breadcrumb,
            'service_areas' => $service_areas,
            'categories' => $categories,
            'services' => $services,
            'currency_icon' => $currency_icon,
            'partner_visbility' => $partner_visbility,
            'partners' => $partners,
        ]);
    }



    public function service($slug){
        $breadcrumb = BreadcrumbImage::where(['id' => 8])->first();
        $service = Service::with('category','provider','activeReviews')->where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        if(!$service){
            return response()->json(['message' => trans('user.Service Not Found')],403);
        }

        $days = array(
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        );

        $schedule_list = array();

        foreach($days as $day_item){
            $schedule_item = AppointmentSchedule::where('user_id', $service->provider_id)->where('day', $day_item)->orderBy('start_time','asc')->first();

            if($schedule_item){
                $start_time = strtoupper(date('h:i A', strtotime($schedule_item->start_time)));

                $schedule_item = AppointmentSchedule::where('user_id', $service->provider_id)->where('day', $day_item)->orderBy('end_time','desc')->first();
                $end_time = strtoupper(date('h:i A', strtotime($schedule_item->end_time)));

                $schedule = array(
                    'day' => $day_item,
                    'start_time' => $start_time,
                    'end_time' => $end_time
                );

                $schedule_list[] = $schedule;
            }
        }

        $what_you_will_get = array();
        if($service->what_you_will_provide){
            $provides = json_decode($service->what_you_will_provide);
            foreach($provides as $provide){
                $what_you_will_get [] = $provide;
            }
        }

        $benifits = array();
        if($service->benifit){
            $exist_benifits = json_decode($service->benifit);
            foreach($exist_benifits as $exist_benifit){
                $benifits [] = $exist_benifit;
            }
        }


        $review_pagiante_qty = CustomPagination::whereId('5')->first()->qty;

        $reviews = Review::with('user')->where(['provider_id' =>  $service->provider_id, 'status' => 1,'service_id' => $service->id])->paginate($review_pagiante_qty);

        $setting = Setting::first();
        $default_avatar = (object) array('image' => $setting->default_avatar);
        $currency_icon = (object) array('icon' => $setting->currency_icon);

        $package_features = array();
        if($service->package_features){
            $features = json_decode($service->package_features);
            foreach($features as $feature){
                $package_features [] = $feature;
            }
        }

        $provider = $service->provider;

        $complete_order = Order::where('order_status','complete')->where('provider_id', $provider->id)->count();

        $total_review = Review::where(['provider_id' =>  $service->provider_id, 'status' => 1])->count();
        $average_rating = Review::where(['provider_id' =>  $service->provider_id, 'status' => 1])->avg('rating');

        $reviewQty = $total_review;
        $reviewPoint = 0;
        $half_rating = false;
        if ($reviewQty > 0) {
            $average = $average_rating;
            $intAverage = intval($average);
            $nextValue = $intAverage + 1;
            $reviewPoint = $intAverage;
            $half_rating = false;
            if($intAverage < $average && $average < $nextValue){
                $reviewPoint = $intAverage + 0.5;
                $half_rating = true;
            }
        }

        $recaptchaSetting = GoogleRecaptcha::first();

        $related_services = Service::with('category','provider')->where(['approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->select('id','name','slug','image','price','category_id','provider_id','is_banned','status','approve_by_admin')->where('category_id', $service->category_id)->where('id','!=', $service->id)->get();


        return response()->json([
            'breadcrumb' => $breadcrumb,
            'service' => $service,
            'what_you_will_get' => $what_you_will_get,
            'benifits' => $benifits,
            'schedule_list' => $schedule_list,
            'reviews' => $reviews,
            'default_avatar' => $default_avatar,
            'currency_icon' => $currency_icon,
            'package_features' => $package_features,
            'provider' => $provider,
            'complete_order' => $complete_order,
            'average_rating' => $average_rating,
            'half_rating' => $half_rating,
            'total_review' => $total_review,
            'review_point' => $reviewPoint,
            'recaptchaSetting' => $recaptchaSetting,
            'related_services' => $related_services,
         ]);
    }

    public function storeServiceReview(Request $request){
        $rules = [
            'provider_id'=>'required',
            'service_id'=>'required',
            'rating'=>'required',
            'comment'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];

        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'email.required' => trans('user_validation.Email is required'),
            'comment.required' => trans('user_validation.Comment is required'),
            'blog_id.required' => trans('user_validation.Blog id is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        // if(!Auth::check('web-api')){
        //     return response()->json(['message' => trans('user_validation.Please Login First')],401);
        // }
        $user = Auth::guard('api')->user();

        $exist_order = Order::where(['client_id' => $user->id, 'service_id' => $request->service_id, 'order_status' => 'complete'])->count();

        if($exist_order == 0){
            $notification = trans('user_validation.You can not make review before book any service');
            return response()->json(['status' => 0, 'message' => $notification],403);
        }

        $exist_review = Review::where(['service_id' => $request->service_id, 'user_id' => $user->id])->count();

        if($exist_review >= $exist_order){
            $notification = trans('user_validation.Review already submited, you can not make multiple review on a single order');
            return response()->json(['status' => 0, 'message' => $notification],403);
        }

        $review = new Review();
        $review->user_id = $user->id;
        $review->service_id = $request->service_id;
        $review->provider_id = $request->provider_id;
        $review->review = $request->comment;
        $review->rating = $request->rating;
        $review->save();

        $notification = trans('user_validation.Review submited successfully');
        return response()->json(['status' => 1, 'message' => $notification]);
    }

    public function provider(Request $request, $user_name){
        $breadcrumb = BreadcrumbImage::where(['id' => 9])->first();

        $provider = User::where(['user_name' => $user_name])->select('id','name','user_name','phone','email','image','created_at','designation','address')->first();

        $setting = Setting::first();
        $default_avatar = (object) array('image' => $setting->default_avatar);
        $currency_icon = (object) array('icon' => $setting->currency_icon);

        $complete_order = Order::where('order_status','complete')->where('provider_id', $provider->id)->count();

        $canceled_order = Order::where('provider_id', $provider->id)->where('order_status','order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client')->count();

        $total_review = Review::where(['provider_id' =>  $provider->id, 'status' => 1])->count();


        $service_pagiante_qty = CustomPagination::whereId('2')->first()->qty;
        $services = Service::with('category','provider')->where(['approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0, 'provider_id' => $provider->id])->orderBy('id','desc')->select('id','name','slug','image','price','category_id','provider_id','is_banned','status','approve_by_admin');

        if($request->search){
            $services = $services->where('name','LIKE','%'.$request->search.'%')
            ->orWhere('details','LIKE','%'.$request->search.'%');
        }

        $services = $services->paginate($service_pagiante_qty);

        $services = $services->appends($request->all());

        $partners = Partner::where(['status' => 1])->get();

        return response()->json([
            'breadcrumb' => $breadcrumb,
            'provider' => $provider,
            'default_avatar' => $default_avatar,
            'currency_icon' => $currency_icon,
            'complete_order' => $complete_order,
            'canceled_order' => $canceled_order,
            'total_review' => $total_review,
            'services' => $services,
            'partners' => $partners,
        ]);
    }

    public function subscribeRequest(Request $request){
        if($request->email != null){
            $isExist = Subscriber::where('email', $request->email)->count();
            if($isExist == 0){
                $subscriber = new Subscriber();
                $subscriber->email = $request->email;
                $subscriber->verified_token = Str::random(25);
                $subscriber->save();

                MailHelper::setMailConfig();

                $template=EmailTemplate::where('id',3)->first();
                $message=$template->description;
                $subject=$template->subject;
                Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber,$message,$subject));

                return response()->json(['status' => 1, 'message' => trans('user_validation.Subscription successfully, please verified your email')]);

            }else{
                return response()->json(['status' => 0, 'message' => trans('user_validation.Email already exist')],403);
            }
        }else{
            return response()->json(['status' => 0, 'message' => trans('user_validation.Email Field is required')],422);
        }
    }

    public function subscriberVerifcation($token){
        $subscriber = Subscriber::where('verified_token',$token)->first();
        if($subscriber){
            $subscriber->verified_token = null;
            $subscriber->is_verified = 1;
            $subscriber->save();
            $notification = trans('user_validation.Email verification successfully');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('home')->with($notification);
        }else{
            $notification = trans('user_validation.Invalid token');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('home')->with($notification);
        }

    }



    public function downloadListingFile($file){
        $filepath= public_path() . "/uploads/custom-images/".$file;
        return response()->download($filepath);
    }


}
