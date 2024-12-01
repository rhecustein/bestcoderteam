<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\HowItWork;
use Illuminate\Http\Request;
use Image;
use File;
class AboutUsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $about = AboutUs::first();

        $how_it_works = HowItWork::all();

        $about_us_section = array(
            'about_us_title' => $about->about_us_title,
            'about_us' => $about->about_us,
            'foreground_image' => $about->foreground_image,
            'background_image' => $about->background_image,
            'client_image_one' => $about->small_image_one,
            'client_image_two' => $about->small_image_two,
            'client_image_three' => $about->small_image_three,
            'total_rating' => $about->total_rating,
        );


        $why_choose_us = array(
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

        return view('admin.about-us',compact('about','how_it_works','about_us_section','why_choose_us'));
    }

    public function addNewHotItWork(Request $request){
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
        ];
        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            'description.required' => trans('admin_validation.Description is required'),
            'image.required' => trans('admin_validation.Image is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $item = new HowItWork();
        $item->title = $request->title;
        $item->description = $request->description;

        if($request->image){
            $extention = $request->image->getClientOriginalExtension();
            $banner_name = 'how-it-work'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/custom-images/'.$banner_name;
            Image::make($request->image)
                ->save(public_path().'/'.$banner_name);
            $item->image = $banner_name;
        }
        $item->save();


        $notification = trans('admin_validation.Created Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function updateHotItWork(Request $request, $id){
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            'description.required' => trans('admin_validation.Description is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $item = HowItWork::find($id);
        $item->title = $request->title;
        $item->description = $request->description;
        $item->save();

        if($request->image){
            $exist_banner = $item->image;
            $extention = $request->image->getClientOriginalExtension();
            $banner_name = 'how-it-work'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/custom-images/'.$banner_name;
            Image::make($request->image)
                ->save(public_path().'/'.$banner_name);
            $item->image = $banner_name;
            $item->save();
            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function deleteHotItWork($id){
        $item = HowItWork::find($id);
        if($item->image){
            $exist_banner = $item->image;
            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        $item->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }


    public function updateHeader(Request $request){
        $rules = [
            'header' => 'required',
            'header_description' => 'required',
        ];
        $customMessages = [
            'header.required' => trans('admin_validation.Header is required'),
            'header_description.required' => trans('admin_validation.Header Description is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $about = AboutUs::first();
        $about->header = $request->header;
        $about->header_description = $request->header_description;
        $about->save();

        $notification = trans('admin_validation.Updated Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function updateAboutUs(Request $request){
        $rules = [
            'about_us_title' => 'required',
            'about_us' => 'required',
        ];
        $customMessages = [
            'about_us_title.required' => trans('admin_validation.About us title is required'),
            'about_us.required' => trans('admin_validation.About us is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $about = AboutUs::first();
        $about->about_us_title = $request->about_us_title;
        $about->about_us = $request->about_us;
        $about->total_rating = $request->total_rating;
        $about->save();

        if($request->background_image){
            $exist_banner = $about->background_image;
            $extention = $request->background_image->getClientOriginalExtension();
            $banner_name = 'about-us-bg'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            Image::make($request->background_image)
                ->save(public_path().'/'.$banner_name);
            $about->background_image = $banner_name;
            $about->save();
            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->foreground_image){
            $exist_banner = $about->foreground_image;
            $extention = $request->foreground_image->getClientOriginalExtension();
            $banner_name = 'about-us-foreground'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            Image::make($request->foreground_image)
                ->save(public_path().'/'.$banner_name);
            $about->foreground_image = $banner_name;
            $about->save();
            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->client_image_one){
            $exist_banner = $about->small_image_one;
            $extention = $request->client_image_one->getClientOriginalExtension();
            $banner_name = 'about-us-client-one'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            Image::make($request->client_image_one)
                ->save(public_path().'/'.$banner_name);
            $about->small_image_one = $banner_name;
            $about->save();
            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->client_image_two){
            $exist_banner = $about->small_image_two;
            $extention = $request->client_image_two->getClientOriginalExtension();
            $banner_name = 'about-us-client-one'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            Image::make($request->client_image_two)
                ->save(public_path().'/'.$banner_name);
            $about->small_image_two = $banner_name;
            $about->save();
            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->client_image_three){
            $exist_banner = $about->small_image_three;
            $extention = $request->client_image_three->getClientOriginalExtension();
            $banner_name = 'about-us-client-one'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            Image::make($request->client_image_three)
                ->save(public_path().'/'.$banner_name);
            $about->small_image_three = $banner_name;
            $about->save();
            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }


        $notification = trans('admin_validation.Updated Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function updateWhyChooseUs(Request $request){
        $rules = [
            'why_choose_us_title' => 'required',
            'why_choose_desciption' => 'required',
        ];
        $customMessages = [
            'why_choose_us_title.required' => trans('admin_validation.Title is required'),
            'why_choose_desciption.required' => trans('admin_validation.Description is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $about = AboutUs::first();
        $about->why_choose_us_title = $request->why_choose_us_title;
        $about->why_choose_desciption = $request->why_choose_desciption;
        $about->title_one = $request->item_one;
        $about->title_two = $request->item_two;
        $about->title_three = $request->item_three;
        $about->description_one = $request->description_one;
        $about->description_two = $request->description_two;
        $about->description_three = $request->description_three;
        $about->save();

        if($request->background_image){
            $exist_banner = $about->why_choose_background;
            $extention = $request->background_image->getClientOriginalExtension();
            $banner_name = 'about-us-bg'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            Image::make($request->background_image)
                ->save(public_path().'/'.$banner_name);
            $about->why_choose_background = $banner_name;
            $about->save();
            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->foreground_image){
            $exist_banner = $about->why_choose_foreground;
            $extention = $request->foreground_image->getClientOriginalExtension();
            $banner_name = 'about-us-foreground'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            Image::make($request->foreground_image)
                ->save(public_path().'/'.$banner_name);
            $about->why_choose_foreground = $banner_name;
            $about->save();
            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }


        $notification = trans('admin_validation.Updated Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
