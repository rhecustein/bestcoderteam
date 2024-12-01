<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Rules\Captcha;
use Auth;
use App\Mail\UserRegistration;
use App\Helpers\MailHelper;
use App\Models\EmailTemplate;
use App\Models\Setting;
use App\Models\BreadcrumbImage;
use App\Models\GoogleRecaptcha;
use App\Models\SocialLoginInformation;
use Mail;
use Str;
use Session;
class RegisterController extends Controller
{

    use RegistersUsers;


    protected $redirectTo = '/dashboard';


    public function __construct()
    {
        $this->middleware('guest:web');
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

        return view('register')->with([
            'active_theme' => $active_theme,
            'breadcrumb' => $breadcrumb,
            'recaptchaSetting' => $recaptchaSetting,
            'socialLogin' => $socialLogin,
            'login_page' => $login_page,
        ]);
    }

    public function storeRegister(Request $request){
        $rules = [
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|min:4',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'name.required' => trans('user_validation.Email is required'),
            'email.required' => trans('user_validation.Email is required'),
            'email.unique' => trans('user_validation.Email already exist'),
            'password.required' => trans('user_validation.Password is required'),
            'password.min' => trans('user_validation.Password must be 4 characters'),
            'password.confirmed' => trans('user_validation.Confirm password does not match'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->verify_token = Str::random(100);
        $user->save();

        MailHelper::setMailConfig();

        $template=EmailTemplate::where('id',4)->first();
        $subject=$template->subject;
        $message=$template->description;
        $message = str_replace('{{user_name}}',$request->name,$message);
        Mail::to($user->email)->send(new UserRegistration($message,$subject,$user));

        $notification = trans('user_validation.Register Successfully. Please Verify your email');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function userVerification($token){
        $user = User::where('verify_token',$token)->first();
        if($user){
            $user->verify_token = null;
            $user->status = 1;
            $user->email_verified = 1;
            $user->save();
            $notification = trans('user_validation.Verification Successfully');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('login')->with($notification);
        }else{
            $notification = trans('user_validation.Invalid token');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('login')->with($notification);
        }
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
