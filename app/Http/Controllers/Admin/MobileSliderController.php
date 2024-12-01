<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MobileSlider;
use App\Models\Setting;
use Image;
use File;

class MobileSliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index(){
        $sliders = MobileSlider::OrderBy('serial','asc')->get();

        return view('admin.mobile_slider', compact('sliders'));
    }

    public function create(){
        return view('admin.create_mobile_slider');
    }

    public function store(Request $request){
        $rules = [
            'title_one' => 'required',
            'title_two' => 'required',
            'serial' => 'required',
            'image' => 'required',
        ];
        $customMessages = [
            'title_one.required' => trans('admin_validation.Title is required'),
            'title_two.required' => trans('admin_validation.Title is required'),
            'serial.required' => trans('admin_validation.Serial is required'),
            'image.required' => trans('admin_validation.Image is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $slider = new MobileSlider();

        if($request->image){

            $extention = $request->image->getClientOriginalExtension();
            $slider_image = 'mb-slider'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $slider_image = 'uploads/custom-images/'.$slider_image;
            Image::make($request->image)
                ->save(public_path().'/'.$slider_image);
            $slider->image = $slider_image;
        }

        $slider->title_one = $request->title_one;
        $slider->title_two = $request->title_two;
        $slider->serial = $request->serial;
        $slider->status = 1;
        $slider->save();

        $notification= trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.mobile-slider.index')->with($notification);
    }

    public function edit($id){
        $slider = MobileSlider::find($id);

        return view('admin.edit_mobile_slider', compact('slider'));
    }

    public function update(Request $request, $id){
        $rules = [
            'title_one' => 'required',
            'title_two' => 'required',
            'serial' => 'required'
        ];
        $customMessages = [
            'title_one.required' => trans('admin_validation.Title is required'),
            'title_two.required' => trans('admin_validation.Title is required'),
            'serial.required' => trans('admin_validation.Serial is required')
        ];
        $this->validate($request, $rules,$customMessages);

        $slider = MobileSlider::find($id);

        if($request->image){
            $existing_slider = $slider->image;
            $extention = $request->image->getClientOriginalExtension();
            $slider_image = 'mb-slider'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $slider_image = 'uploads/custom-images/'.$slider_image;
            Image::make($request->image)
                ->save(public_path().'/'.$slider_image);
            $slider->image = $slider_image;
            $slider->save();
            if($existing_slider){
                if(File::exists(public_path().'/'.$existing_slider))unlink(public_path().'/'.$existing_slider);
            }
        }

        $slider->title_one = $request->title_one;
        $slider->title_two = $request->title_two;
        $slider->serial = $request->serial;
        $slider->status = 1;
        $slider->save();

        $notification= trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.mobile-slider.index')->with($notification);
    }

    public function destroy($id){
        $slider = MobileSlider::find($id);
        $existing_slider = $slider->image;
        $slider->delete();
        if($existing_slider){
            if(File::exists(public_path().'/'.$existing_slider))unlink(public_path().'/'.$existing_slider);
        }

        $notification= trans('admin_validation.Deleted Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.mobile-slider.index')->with($notification);
    }
}
