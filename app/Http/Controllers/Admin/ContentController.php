<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MaintainanceText;
use App\Models\Setting;
use App\Models\BannerImage;
use App\Models\SeoSetting;
use App\Models\SectionContent;
use App\Models\SectionControl;
use Image;
use File;
class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function maintainanceMode()
    {
        $maintainance = MaintainanceText::first();
        return view('admin.maintainance_mode', compact('maintainance'));
    }

    public function maintainanceModeUpdate(Request $request)
    {
        $rules = [
            'description'=> $request->maintainance_mode ? 'required' : ''
        ];
        $customMessages = [
            'description.required' => trans('admin_validation.Description is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $maintainance = MaintainanceText::first();
        if($request->image){
            $old_image=$maintainance->image;
            $image=$request->image;
            $ext=$image->getClientOriginalExtension();
            $image_name= 'maintainance-mode-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $image_name='uploads/website-images/'.$image_name;
            Image::make($image)
                ->save(public_path().'/'.$image_name);
            $maintainance->image=$image_name;
            $maintainance->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }
        $maintainance->status = $request->maintainance_mode ? 1 : 0;
        $maintainance->description = $request->description;
        $maintainance->save();

        $notification= trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function headerPhoneNumber(){
        $setting = Setting::first();
        return view('admin.header_phone_number',compact('setting'));
    }

    public function updateHeaderPhoneNumber(Request $request){
        $rules = [
            'topbar_phone'=>'required',
            'topbar_email'=>'required',
            'opening_time'=>'required'
        ];
        $customMessages = [
            'topbar_phone.required' => trans('admin_validation.Header phone is required'),
            'topbar_email.required' => trans('admin_validation.Header email is required'),
            'opening_time.required' => trans('admin_validation.Opening time is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $setting = Setting::first();
        $setting->topbar_phone = $request->topbar_phone;
        $setting->topbar_email = $request->topbar_email;
        $setting->opening_time = $request->opening_time;
        $setting->save();

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function joinAsAProvider(){
        $setting = Setting::first();

        $join_as_a_provider = array(
            'image' => $setting->join_as_a_provider_banner,
            'home3_image' => $setting->home3_join_as_provider,
            'home2_image' => $setting->home2_join_as_provider,
            'title' => $setting->join_as_a_provider_title,
            'button_text' => $setting->join_as_a_provider_btn,
        );
        $join_as_a_provider = (object) $join_as_a_provider;

        $selected_theme = $setting->selected_theme;

        return view('admin.join_as_a_provider',compact('join_as_a_provider','selected_theme'));
    }

    public function updatejoinAsAProvider(Request $request){
        $rules = [
            'title'=>'required',
            'button_text'=>'required',
        ];
        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            'button_text.required' => trans('admin_validation.Button text is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $setting = Setting::first();
        $setting->join_as_a_provider_title = $request->title;
        $setting->join_as_a_provider_btn = $request->button_text;
        $setting->save();

        if($request->image){
            $old_image = $setting->join_as_a_provider_banner;
            $extention=$request->image->getClientOriginalExtension();
            $image_name = 'join-provider-bg-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->image)
                ->save(public_path().'/'.$image_name);
            $setting->join_as_a_provider_banner = $image_name;
            $setting->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->image2){
            $old_image = $setting->home2_join_as_provider;
            $extention=$request->image2->getClientOriginalExtension();
            $image_name = 'join-provider-home2bg-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->image2)
                ->save(public_path().'/'.$image_name);
            $setting->home2_join_as_provider = $image_name;
            $setting->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->image3){
            $old_image = $setting->home3_join_as_provider;
            $extention=$request->image3->getClientOriginalExtension();
            $image_name = 'join-provider-home2bg-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->image3)
                ->save(public_path().'/'.$image_name);
            $setting->home3_join_as_provider = $image_name;
            $setting->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }


        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function mobileApp(){
        $setting = Setting::first();

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

        $selected_theme = $setting->selected_theme;

        return view('admin.mobile_app',compact('mobile_app','selected_theme'));
    }


    public function updateMobileApp(Request $request){
        $rules = [
            'short_title'=>'required',
            'full_title'=>'required',
            'description'=>'required',
            'play_store'=>'required',
            'app_store'=>'required',
        ];
        $customMessages = [
            'short_title.required' => trans('admin_validation.Short title is required'),
            'full_title.required' => trans('admin_validation.Title is required'),
            'description.required' => trans('admin_validation.Description is required'),
            'play_store.required' => trans('admin_validation.Play store is required'),
            'app_store.required' => trans('admin_validation.App store is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $setting = Setting::first();
        $setting->app_short_title = $request->short_title;
        $setting->app_full_title = $request->full_title;
        $setting->app_description = $request->description;
        $setting->google_playstore_link = $request->play_store;
        $setting->app_store_link = $request->app_store;
        $setting->save();

        if($request->image){
            $old_image = $setting->app_image;
            $extention=$request->image->getClientOriginalExtension();
            $image_name = 'mobile-app-bg-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->image)
                ->save(public_path().'/'.$image_name);
            $setting->app_image = $image_name;
            $setting->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->image2){
            $old_image = $setting->home2_app_image;
            $extention=$request->image2->getClientOriginalExtension();
            $image_name = 'mobile-app-bg-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->image2)
                ->save(public_path().'/'.$image_name);
            $setting->home2_app_image = $image_name;
            $setting->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->image3){
            $old_image = $setting->home3_app_image;
            $extention=$request->image3->getClientOriginalExtension();
            $image_name = 'mobile-app-bg-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->image3)
                ->save(public_path().'/'.$image_name);
            $setting->home3_app_image = $image_name;
            $setting->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }


        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function subscriberSection(){
        $setting = Setting::first();

        $subscriber = array(
            'title' => $setting->subscriber_title,
            'description' => $setting->subscriber_description,
            'image' => $setting->subscriber_image,
            'background_image' => $setting->subscription_bg,
            'home2_background_image' => $setting->home2_subscription_bg,
            'home3_background_image' => $setting->home3_subscription_bg,
            'blog_page_subscription_image' => $setting->blog_page_subscription_image,
        );
        $subscriber = (object) $subscriber;

        $selected_theme = $setting->selected_theme;

        return view('admin.subscriber_section',compact('subscriber','selected_theme'));
    }

    public function updateSubscriberSection(Request $request){
        $rules = [
            'title'=>'required',
            'description'=>'required'
        ];
        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            'description.required' => trans('admin_validation.Description is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $setting = Setting::first();
        $setting->subscriber_title = $request->title;
        $setting->subscriber_description = $request->description;
        $setting->save();

        if($request->image){
            $old_image = $setting->subscriber_image;
            $extention=$request->image->getClientOriginalExtension();
            $image_name = 'sub-foreground-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->image)
                ->save(public_path().'/'.$image_name);
            $setting->subscriber_image = $image_name;
            $setting->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }



        if($request->background_image){
            $old_image = $setting->subscription_bg;
            $extention=$request->background_image->getClientOriginalExtension();
            $image_name = 'sub-background'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->background_image)
                ->save(public_path().'/'.$image_name);
            $setting->subscription_bg = $image_name;
            $setting->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->background_image2){
            $old_image = $setting->home2_subscription_bg;
            $extention=$request->background_image2->getClientOriginalExtension();
            $image_name = 'sub-background'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->background_image2)
                ->save(public_path().'/'.$image_name);
            $setting->home2_subscription_bg = $image_name;
            $setting->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->background_image3){
            $old_image = $setting->home3_subscription_bg;
            $extention=$request->background_image3->getClientOriginalExtension();
            $image_name = 'sub-background'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->background_image3)
                ->save(public_path().'/'.$image_name);
            $setting->home3_subscription_bg = $image_name;
            $setting->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }



        if($request->blog_page_subscription_image){
            $old_image = $setting->blog_page_subscription_image;
            $extention = $request->blog_page_subscription_image->getClientOriginalExtension();
            $image_name = 'blog-sub-background'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->blog_page_subscription_image)
                ->save(public_path().'/'.$image_name);
            $setting->blog_page_subscription_image = $image_name;
            $setting->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }



        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }



    public function home2Contact(){
        $setting = Setting::first();

        $contact = (object) array(
            'foreground' => $setting->home2_contact_foreground,
            'background' => $setting->home2_contact_background,
            'call_as_now' => $setting->home2_contact_call_as,
            'phone' => $setting->home2_contact_phone,
            'available_time' => $setting->home2_contact_available,
            'form_title' => $setting->home2_contact_form_title,
            'form_description' => $setting->home2_contact_form_description,
        );

        return view('admin.home2_contact',compact('contact'));

    }

    public function updateHome2Contact(Request $request){
        $rules = [
            'call_as_now'=>'required',
            'phone'=>'required',
            'available_time'=>'required',
            'form_title'=>'required',
            'form_description'=>'required'
        ];
        $customMessages = [
            'call_as_now.required' => trans('admin_validation.Call as now is required'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'available_time.required' => trans('admin_validation.Available time is required'),
            'form_title.required' => trans('admin_validation.Form title is required'),
            'form_description.required' => trans('admin_validation.Form description is required'),
        ];
        $this->validate($request, $rules,$customMessages);


        $setting = Setting::first();

        $setting->home2_contact_call_as = $request->call_as_now;
        $setting->home2_contact_phone = $request->phone;
        $setting->home2_contact_available = $request->available_time;
        $setting->home2_contact_form_title = $request->form_title;
        $setting->home2_contact_form_description = $request->form_description;
        $setting->save();

        if($request->image){
            $old_image = $setting->home2_contact_foreground;
            $extention=$request->image->getClientOriginalExtension();
            $image_name = 'home2-contact-foreground-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->image)
                ->save(public_path().'/'.$image_name);
            $setting->home2_contact_foreground = $image_name;
            $setting->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->background_image){
            $old_image = $setting->home2_contact_background;
            $extention=$request->background_image->getClientOriginalExtension();
            $image_name = 'home2-contact-background'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->background_image)
                ->save(public_path().'/'.$image_name);
            $setting->home2_contact_background = $image_name;
            $setting->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }


        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function howItWork(){
        $setting = Setting::first();
        $how_it_work = (object) array(
            'background' => $setting->how_it_work_background,
            'foreground' => $setting->how_it_work_foreground,
            'title' => $setting->how_it_work_title,
            'description' => $setting->how_it_work_description,
            'items' => json_decode($setting->how_it_work_items),
        );

        return view('admin.how_it_work',compact('how_it_work'));
    }


    public function updateHowItWork(Request $request){
        $rules = [
            'title'=>'required',
            'description'=>'required',
        ];
        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            'description.required' => trans('admin_validation.Description is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $setting = Setting::first();
        $setting->how_it_work_title = $request->title;
        $setting->how_it_work_description = $request->description;
        $setting->save();

        if($request->image){
            $old_image = $setting->how_it_work_foreground;
            $extention=$request->image->getClientOriginalExtension();
            $image_name = 'home3-hiw-foreground-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->image)
                ->save(public_path().'/'.$image_name);
            $setting->how_it_work_foreground = $image_name;
            $setting->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->background_image){
            $old_image = $setting->how_it_work_background;
            $extention=$request->background_image->getClientOriginalExtension();
            $image_name = 'home3-hiw-background'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->background_image)
                ->save(public_path().'/'.$image_name);
            $setting->how_it_work_background = $image_name;
            $setting->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        $items = array();
        if($request->titles && $request->descriptions){
            foreach($request->titles as $index => $title){
                $item = array();
                if($request->titles[$index] && $request->descriptions[$index]){
                    $item = [
                        'title' => $request->titles[$index],
                        'description' => $request->descriptions[$index],
                    ];

                    $items[] = $item;
                }
            }
        }

        $items = json_encode($items);
        $setting->how_it_work_items = $items;
        $setting->save();



        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }


    public function sectionContent(){
        $contents = SectionContent::all();

        return view('admin.section_content',compact('contents'));
    }


    public function updateSectionContent(Request $request, $id){
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            'description.required' => trans('admin_validation.Description is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $section = SectionContent::find($id);
        $section->title = $request->title;
        $section->description = $request->description;
        $section->save();

        $notification = trans('admin_validation.Updated Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }


    public function sectionControl(){
        $homepage = SectionControl::get();

        return view('admin.section_control',compact('homepage'));
    }


    public function updateSectionControl(Request $request){
        foreach($request->ids as $index => $id){
            $section = SectionControl::find($id);
            $section->status = $request->status[$index];
            $section->qty = $request->quanities[$index];
            $section->save();
        }

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function seoSetup(){
        $pages = SeoSetting::all();
        return view('admin.seo_setup', compact('pages'));
    }

    public function updateSeoSetup(Request $request, $id){
        $rules = [
            'seo_title' => 'required',
            'seo_description' => 'required'
        ];
        $customMessages = [
            'seo_title.required' => trans('admin_validation.Seo title is required'),
            'seo_description.required' => trans('admin_validation.Seo description is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $page = SeoSetting::find($id);
        $page->seo_title = $request->seo_title;
        $page->seo_description = $request->seo_description;
        $page->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function defaultAvatar(){
        $setting = Setting::first();
        $default_avatar = array(
            'image' => $setting->default_avatar
        );
        $default_avatar = (object) $default_avatar;
        return view('admin.default_profile_image', compact('default_avatar'));
    }

    public function updateDefaultAvatar(Request $request){
        $setting = Setting::first();
        if($request->avatar){
            $existing_avatar = $setting->default_avatar;
            $extention = $request->avatar->getClientOriginalExtension();
            $default_avatar = 'default-avatar'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $default_avatar = 'uploads/website-images/'.$default_avatar;
            Image::make($request->avatar)
                ->save(public_path().'/'.$default_avatar);
            $setting->default_avatar = $default_avatar;
            $setting->save();
            if($existing_avatar){
                if(File::exists(public_path().'/'.$existing_avatar))unlink(public_path().'/'.$existing_avatar);
            }
        }

        $notification = trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function login_page(){
        $setting = Setting::first();
        $login_page = array(
            'image' => $setting->login_image
        );
        $login_page = (object) $login_page;
        return view('admin.login_page', compact('login_page'));
    }

    public function update_login_page(Request $request){
        $setting = Setting::first();
        if($request->image){
            $existing_avatar = $setting->default_avatar;
            $extention = $request->image->getClientOriginalExtension();
            $default_avatar = 'login-page'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $default_avatar = 'uploads/website-images/'.$default_avatar;
            Image::make($request->image)
                ->save(public_path().'/'.$default_avatar);
            $setting->login_image = $default_avatar;
            $setting->save();
            if($existing_avatar){
                if(File::exists(public_path().'/'.$existing_avatar))unlink(public_path().'/'.$existing_avatar);
            }
        }

        $notification = trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }



}
