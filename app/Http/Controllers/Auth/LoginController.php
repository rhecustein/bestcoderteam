<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Models\BreadcrumbImage;
use App\Models\GoogleRecaptcha;
use App\Models\User;
use App\Rules\Captcha;
use App\Mail\UserForgetPassword;
use App\Helpers\MailHelper;
use App\Models\EmailTemplate;
use App\Models\SocialLoginInformation;
use App\Models\Setting;
use Mail;
use Str;
use Validator,Redirect,Response,File;
use Socialite;
use Auth;
use Hash;
use Session;
class LoginController extends Controller
{

    use AuthenticatesUsers;
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest:web')->except('userLogout');
    }

    public function loginPage(){
        $breadcrumb = BreadcrumbImage::where(['id' => 11])->first();
        $recaptchaSetting = GoogleRecaptcha::first();
        $socialLogin = SocialLoginInformation::first();

        $setting = Setting::first();
        $login_page = array(
            'image' => $setting->login_image
        );
        $login_page = (object) $login_page;


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

        return view('login')->with([
            'active_theme' => $active_theme,
            'breadcrumb' => $breadcrumb,
            'recaptchaSetting' => $recaptchaSetting,
            'socialLogin' => $socialLogin,
            'login_page' => $login_page,
        ]);
    }

    public function storeLogin(Request $request){
        $rules = [
            'email'=>'required',
            'password'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'email.required' => trans('user_validation.Email is required'),
            'password.required' => trans('user_validation.Password is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $credential=[
            'email'=> $request->email,
            'password'=> $request->password
        ];
        $user = User::where('email',$request->email)->first();
        if($user){
            if($user->status==1){
                if(Hash::check($request->password,$user->password)){
                    if(Auth::guard('web')->attempt($credential,$request->remember)){
                        $notification = trans('user_validation.Login Successfully');
                        $notification=array('messege'=>$notification,'alert-type'=>'success');
                        if($user->is_provider == 1) {
                            return redirect()->route('provider.dashboard')->with($notification);
                        }else {
                            return redirect()->intended(route('dashboard'))->with($notification);
                        }

                    }
                }else{
                    $notification = trans('user_validation.Credentials does not exist');
                    $notification=array('messege'=>$notification,'alert-type'=>'error');
                    return redirect()->back()->with($notification);
                }

            }else{
                $notification = trans('user_validation.Disabled Account');
                $notification=array('messege'=>$notification,'alert-type'=>'error');
                return redirect()->back()->with($notification);
            }
        }else{
            $notification = trans('user_validation.Email does not exist');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
    }

    public function forgetPage(){
        $breadcrumb = BreadcrumbImage::where(['id' => 11])->first();
        $recaptchaSetting = GoogleRecaptcha::first();

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

        return view('forget_password')->with([
            'active_theme' => $active_theme,
            'breadcrumb' => $breadcrumb,
            'recaptchaSetting' => $recaptchaSetting,
        ]);
    }

    public function sendForgetPassword(Request $request){
        $rules = [
            'email'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'email.required' => trans('user_validation.Email is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = User::where('email', $request->email)->first();

        if($user){
            $user->forget_password_token = Str::random(100);
            $user->save();

            MailHelper::setMailConfig();
            $template = EmailTemplate::where('id',1)->first();
            $subject = $template->subject;
            $message = $template->description;
            $message = str_replace('{{name}}',$user->name,$message);
            Mail::to($user->email)->send(new UserForgetPassword($message,$subject,$user));

            $notification = trans('user_validation.Reset password link send to your email.');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->back()->with($notification);

        }else{
            $notification = trans('user_validation.Email does not exist');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
    }


    public function resetPasswordPage($token){
        $user = User::select('id','name','email','forget_password_token')->where('forget_password_token', $token)->first();
        $breadcrumb = BreadcrumbImage::where(['id' => 11])->first();
        $recaptchaSetting = GoogleRecaptcha::first();

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

        return view('reset_password')->with([
            'active_theme' => $active_theme,
            'breadcrumb' => $breadcrumb,
            'recaptchaSetting' => $recaptchaSetting,
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function storeResetPasswordPage(Request $request, $token){
        $rules = [
            'email'=>'required',
            'password'=>'required|min:4|confirmed',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'email.required' => trans('user_validation.Email is required'),
            'password.required' => trans('user_validation.Password is required'),
            'password.min' => trans('user_validation.Password must be 4 characters'),
            'password.confirmed' => trans('user_validation.Confirm password does not match'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = User::where(['email' => $request->email, 'forget_password_token' => $token])->first();
        if($user){
            $user->password=Hash::make($request->password);
            $user->forget_password_token=null;
            $user->save();

            $notification = trans('user_validation.Password Reset successfully');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('login')->with($notification);
        }else{
            $notification = trans('user_validation.Something went wrong');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('login')->with($notification);
        }
    }

    public function userLogout(){
        Auth::guard('web')->logout();
        $notification= trans('user_validation.Logout Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('login')->with($notification);
    }

    public function redirectToGoogle(){
        $googleInfo = SocialLoginInformation::first();
        \Config::set('services.google.client_id', $googleInfo->gmail_client_id);
        \Config::set('services.google.client_secret', $googleInfo->gmail_secret_id);
        \Config::set('services.google.redirect', $googleInfo->gmail_redirect_url);

        return Socialite::driver('google')->redirect();
    }

    public function googleCallBack(){

        $googleInfo = SocialLoginInformation::first();
        \Config::set('services.google.client_id', $googleInfo->gmail_client_id);
        \Config::set('services.google.client_secret', $googleInfo->gmail_secret_id);
        \Config::set('services.google.redirect', $googleInfo->gmail_redirect_url);

        $user = Socialite::driver('google')->user();
        $user = $this->createUser($user,'google');
        auth()->login($user);
        return redirect()->intended(route('dashboard'));
    }

    public function redirectToFacebook(){

        $facebookInfo = SocialLoginInformation::first();
        if($facebookInfo){
            \Config::set('services.facebook.client_id', $facebookInfo->facebook_client_id);
            \Config::set('services.facebook.client_secret', $facebookInfo->facebook_secret_id);
            \Config::set('services.facebook.redirect', $facebookInfo->facebook_redirect_url);
        }

        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallBack(){
        $facebookInfo = SocialLoginInformation::first();
        if($facebookInfo){
            \Config::set('services.facebook.client_id', $facebookInfo->facebook_client_id);
            \Config::set('services.facebook.client_secret', $facebookInfo->facebook_secret_id);
            \Config::set('services.facebook.redirect', $facebookInfo->facebook_redirect_url);
        }

        $user = Socialite::driver('facebook')->user();
        $user = $this->createUser($user,'facebook');
        auth()->login($user);
        return redirect()->intended(route('dashboard'));
    }



    function createUser($getInfo,$provider){
        $user = User::where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'provider_avatar' => $getInfo->avatar,
                'status' => 1,
                'email_verified' => 1,
            ]);
        }
        return $user;
    }
}
