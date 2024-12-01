<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Setting;
use Image;
use File;
class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $slider = Slider::first();

        $setting = Setting::first();
        $selected_theme = $setting->selected_theme;

        return view('admin.create_slider', compact('slider','selected_theme'));
    }

    public function update(Request $request, $id){
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'header_one' => 'required',
            'header_two' => 'required',
            'total_service_sold' => 'required'
        ];
        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            'description.required' => trans('admin_validation.Description is required'),
            'header_one.required' => trans('admin_validation.Header one is required'),
            'header_two.required' => trans('admin_validation.Header two is required'),
            'total_service_sold.required' => trans('admin_validation.Total sold service is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $slider = Slider::find($id);
        if($request->image){
            $existing_slider = $slider->image;
            $extention = $request->image->getClientOriginalExtension();
            $slider_image = 'slider'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $slider_image = 'uploads/website-images/'.$slider_image;
            Image::make($request->image)
                ->save(public_path().'/'.$slider_image);
            $slider->image = $slider_image;
            $slider->save();
            if($existing_slider){
                if(File::exists(public_path().'/'.$existing_slider))unlink(public_path().'/'.$existing_slider);
            }
        }

        if($request->image2){
            $existing_slider = $slider->home2_image;
            $extention = $request->image2->getClientOriginalExtension();
            $slider_image = 'slider'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $slider_image = 'uploads/website-images/'.$slider_image;
            Image::make($request->image2)
                ->save(public_path().'/'.$slider_image);
            $slider->home2_image = $slider_image;
            $slider->save();
            if($existing_slider){
                if(File::exists(public_path().'/'.$existing_slider))unlink(public_path().'/'.$existing_slider);
            }
        }

        if($request->image3){
            $existing_slider = $slider->home3_image;
            $extention = $request->image3->getClientOriginalExtension();
            $slider_image = 'slider'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $slider_image = 'uploads/website-images/'.$slider_image;
            Image::make($request->image3)
                ->save(public_path().'/'.$slider_image);
            $slider->home3_image = $slider_image;
            $slider->save();
            if($existing_slider){
                if(File::exists(public_path().'/'.$existing_slider))unlink(public_path().'/'.$existing_slider);
            }
        }

        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->header_one = $request->header_one;
        $slider->header_two = $request->header_two;
        $slider->total_service_sold = $request->total_service_sold;
        $slider->popular_tag = $request->popular_tag;
        $slider->save();

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

}
