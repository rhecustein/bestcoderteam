<?php

namespace App\Http\Controllers\API\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\City;
use App\Models\Setting;
use App\Models\BannerImage;
use App\Models\Schedule;
use App\Models\Order;
use App\Models\ProviderWithdraw;
use App\Models\Service;
use Auth;
use Image;
use File;
use Str;
use Hash;
class ProviderProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){

        $user = Auth::guard('api')->user();
        $user = User::select('id','name','email','image','phone','designation','status','is_provider','country_id','state_id','city_id','address','created_at')->where('id', $user->id)->first();

        $countries = Country::orderBy('name','asc')->select('id','name')->where('status',1)->get();
        $states = CountryState::orderBy('name','asc')->select('id','name','country_id')->where(['status' => 1, 'country_id' => $user->country_id])->get();
        $cities = City::orderBy('name','asc')->select('id','name','country_state_id')->where(['status' => 1, 'country_state_id' => $user->state_id])->get();

        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        $default_avatar = array(
            'image' => $setting->default_avatar
        );
        $default_avatar = (object) $default_avatar;

        $provider = $user;
        $orders = Order::where('provider_id', $provider->id)->where('order_status', 'complete')->get();
        $total_sold_service = $orders->count();

        $total_balance = $orders->sum('total_amount');

        $total_withdraw = ProviderWithdraw::where('user_id', $provider->id)->sum('total_amount');

        $current_balance = $total_balance - $total_withdraw;

        $services = Service::where('provider_id', $provider->id)->get();
        $total_service = $services->count();


        return response()->json([
            'user' => $user,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'currency_icon' => $currency_icon,
            'default_avatar' => $default_avatar,
            'total_sold_service' => $total_sold_service,
            'total_balance' => $total_balance,
            'total_withdraw' => $total_withdraw,
            'total_service' => $total_service,
            'current_balance' => $current_balance,
        ]);
    }

    public function changePassword(){
        return view('provider.change_password');
    }

    public function stateByCountry($id){
        $states = CountryState::where(['status' => 1, 'country_id' => $id])->get();
        $response='<option value="">'.trans('user_validation.Select').'</option>';
        if($states->count() > 0){
            foreach($states as $state){
                $response .= "<option value=".$state->id.">".$state->name."</option>";
            }
        }

        return response()->json(['states'=>$response]);
    }

    public function cityByState($id){
        $cities = City::where(['status' => 1, 'country_state_id' => $id])->get();
        $response='<option value="">'.trans('user_validation.Select').'</option>';
        if($cities->count() > 0){
            foreach($cities as $city){
                $response .= "<option value=".$city->id.">".$city->name."</option>";
            }
        }

        return response()->json(['cities'=>$response]);
    }

    public function updateSellerProfile(Request $request){
        $user = Auth::guard('api')->user();
        $rules = [
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$user->id,
            'phone'=>'required',
            'country'=>'required',
            'state'=>'required',
            'city'=>'required',
            'designation'=>'required',
            'address'=>'required',
        ];
        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'email.required' => trans('user_validation.Email is required'),
            'email.unique' => trans('user_validation.Email already exist'),
            'phone.required' => trans('user_validation.Phone is required'),
            'country.required' => trans('user_validation.Country or region is required'),
            'state.required' => trans('user_validation.State or province is required'),
            'city.required' => trans('user_validation.Service area is required'),
            'designation.required' => trans('user_validation.Desgination is required'),
            'address.required' => trans('user_validation.Address is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->country_id = $request->country;
        $user->state_id = $request->state;
        $user->city_id = $request->city;
        $user->address = $request->address;
        $user->designation = $request->designation;
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

        $notification= trans('user_validation.Update Successfully');
        return response()->json(['message' => $notification]);
    }

    public function updatePassword(Request $request){
        $user = Auth::guard('api')->user();
        $rules = [
            'password'=>'required|min:4|confirmed',
        ];

        $customMessages = [
            'password.required' => trans('user_validation.Password is required'),
            'password.min' => trans('user_validation.Password must be 4 characters'),
            'password.confirmed' => trans('user_validation.Confirm password does not match'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user->password = Hash::make($request->password);
        $user->save();
        $notification= trans('user_validation.Password Change Successfully');
        return response()->json(['message' => $notification]);
    }

    public function schedule(){
        $user = Auth::guard('api')->user();
        $schedules = Schedule::where('provider_id', $user->id)->get();
        $days = array(
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        );


        return response()->json(['schedules' => $schedules, 'days' => $days]);
    }


    public function updateSchedule(Request $request){
        $user = Auth::guard('api')->user();
        $is_scheudle = Schedule::where('provider_id', $user->id)->count();
        if($is_scheudle){
            foreach($request->ids as $index => $id){
                $schedule = Schedule::find($id);
                $schedule->start = $request->start[$index];
                $schedule->end = $request->end[$index];
                $schedule->status = $request->status[$index];
                $schedule->save();
            }
        }else{
            foreach($request->days as $index => $day){
                $schedule = new Schedule();
                $schedule->provider_id = $user->id;
                $schedule->day = $day;
                $schedule->start = $request->start[$index];
                $schedule->end = $request->end[$index];
                $schedule->status = $request->status[$index];
                $schedule->serial_of_day = $index;
                $schedule->save();
            }
        }
        $notification= trans('user_validation.Update Successfully');
        return response()->json(['message' => $notification]);
    }

}
