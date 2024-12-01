<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactPage;
use Image;
use File;
class ContactPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $contact = ContactPage::first();
        return view('admin.contact_page', compact('contact'));
    }

    public function update(Request $request, $id){
        $rules = [
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'support_time' => 'required',
            'google_map' => 'required',
            'off_day' => 'required',
        ];
        $customMessages = [
            'email.required' => trans('admin_validation.Email is required'),
            'phone.unique' => trans('admin_validation.Phone is required'),
            'address.unique' => trans('admin_validation.Address is required'),
            'support_time.unique' => trans('admin_validation.Support time is required'),
            'google_map.unique' => trans('admin_validation.Google Map is required'),
            'off_day.unique' => trans('admin_validation.Off day is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $contact = ContactPage::find($id);
        if($request->supporter_image){
            $exist_banner = $contact->supporter_image;
            $extention = $request->supporter_image->getClientOriginalExtension();
            $banner_name = 'supporter-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            Image::make($request->supporter_image)
                ->save(public_path().'/'.$banner_name);
            $contact->supporter_image = $banner_name;
            $contact->save();
            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->address = $request->address;
        $contact->support_time = $request->support_time;
        $contact->map = $request->google_map;
        $contact->off_day = $request->off_day;
        $contact->save();

        $notification = trans('admin_validation.Updated Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

}
