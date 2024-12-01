<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Setting;
use Illuminate\Http\Request;
use Image;
use File;
class CounterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $counters = Counter::all();
        $setting = Setting::first()->counter_bg_image;
        $counter_bg_image = array(
            'counter_bg_image' => $setting
        );
        $counter_bg_image = (object) $counter_bg_image;



        return view('admin.counter',compact('counters','counter_bg_image'));
    }

    public function create()
    {
        return view('admin.create_counter');
    }


    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'icon' => 'required',
            'number' => 'required',
            'status' => 'required'
        ];
        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            'title.unique' => trans('admin_validation.Title already exist'),
            'icon.required' => trans('admin_validation.Icon is required'),
            'number.required' => trans('admin_validation.Number is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $counter = new Counter();
        $counter->title = $request->title;
        $counter->icon = $request->icon;
        $counter->number = $request->number;
        $counter->status = $request->status;
        if($request->icon){
            $extention=$request->icon->getClientOriginalExtension();
            $image_name = 'counter-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/custom-images/'.$image_name;
            Image::make($request->icon)
                ->save(public_path().'/'.$image_name);
            $counter->icon = $image_name;
        }
        $counter->save();

        $notification = trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.counter.index')->with($notification);
    }


    public function edit($id)
    {
        $counter = Counter::find($id);
        return view('admin.edit_counter',compact('counter'));
    }


    public function update(Request $request, $id)
    {
        $counter = Counter::find($id);
        $rules = [
            'title' => 'required',
            'number' => 'required',
            'status' => 'required'
        ];
        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            'title.unique' => trans('admin_validation.Title already exist'),
            'number.required' => trans('admin_validation.Number is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $counter->title = $request->title;
        $counter->number = $request->number;
        $counter->status = $request->status;
        if($request->icon){
            $old_image = $counter->icon;
            $extention=$request->icon->getClientOriginalExtension();
            $image_name = 'counter-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/custom-images/'.$image_name;
            Image::make($request->icon)
                ->save(public_path().'/'.$image_name);
            $counter->icon = $image_name;
            $counter->save();

            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }
        $counter->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.counter.index')->with($notification);
    }


    public function destroy($id)
    {
        $counter = Counter::find($id);
        $old_image = $counter->icon;
        $counter->delete();
        if($old_image){
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
        }

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.counter.index')->with($notification);
    }

    public function changeStatus($id){
        $counter = Counter::find($id);
        if($counter->status == 1){
            $counter->status = 0;
            $counter->save();
            $message = trans('admin_validation.Inactive Successfully');
        }else{
            $counter->status = 1;
            $counter->save();
            $message = trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }

    public function updateCounterBg(Request $request){
        $setting = Setting::first();
        if($request->image){
            $old_image = $setting->image;
            $extention=$request->image->getClientOriginalExtension();
            $image_name = 'counter-bg-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->image)
                ->save(public_path().'/'.$image_name);
            $setting->counter_bg_image = $image_name;
            $setting->save();

            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        $notification = trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.counter.index')->with($notification);
    }
}
