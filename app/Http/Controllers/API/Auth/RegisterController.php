<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Rules\Captcha;
use Auth;
use App\Mail\UserRegistrationForOTP;
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
        $this->middleware('guest:api');
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

        return response()->json([
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
        $user->otp_mail_verify_token = random_int(100000, 999999);
        $user->save();

        MailHelper::setMailConfig();

        $template=EmailTemplate::where('id',10)->first();
        $subject=$template->subject;
        $message=$template->description;
        $message = str_replace('{{user_name}}',$request->name,$message);
        Mail::to($user->email)->send(new UserRegistrationForOTP($message,$subject,$user));

        $notification = trans('user_validation.Register Successfully. Please Verify your email');
        return response()->json(['message' => $notification]);
    }

    public function resendRegisterCode(Request $request){
        $rules = [
            'email'=>'required',
        ];
        $customMessages = [
            'email.required' => trans('user_validation.Email is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = User::where('email', $request->email)->first();
        if($user){
            if($user->email_verified == 0){
                MailHelper::setMailConfig();

                $template=EmailTemplate::where('id',10)->first();
                $subject=$template->subject;
                $message=$template->description;
                $message = str_replace('{{user_name}}',$user->name,$message);
                Mail::to($user->email)->send(new UserRegistrationForOTP($message,$subject,$user));

                $notification = trans('user_validation.Register Successfully. Please Verify your email');
                return response()->json(['notification' => $notification]);

            }else{
                $notification = trans('user_validation.Already verfied your account');
                return response()->json(['notification' => $notification],403);
            }
        }else{
            $notification = trans('user_validation.Email does not exist');
            return response()->json(['notification' => $notification],403);
        }

    }

    public function userVerification($token){
        $user = User::where('otp_mail_verify_token',$token)->first();
        if($user){
            $user->otp_mail_verify_token = null;
            $user->status = 1;
            $user->email_verified = 1;
            $user->save();
            $notification = trans('user_validation.Verification Successfully');
            return response()->json(['message' => $notification]);
        }else{
            $notification = trans('user_validation.Invalid token');
            return response()->json(['message' => $notification],403);
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
