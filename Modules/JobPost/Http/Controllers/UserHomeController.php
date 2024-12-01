<?php

namespace Modules\JobPost\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\User;
use App\Models\Setting;
use Modules\JobPost\Entities\JobRequest;

use Auth, Image, File, Str, Session;
use App\Models\City;

use Modules\JobPost\Entities\JobPost;
use App\Models\Category;
use App\Models\BreadcrumbImage;
use Modules\Language\Entities\Language;

use Modules\JobPost\Entities\JobPostTranslation;
use Modules\JobPost\Http\Requests\JobPostRequest;

class UserHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::guard('web')->user();

        $job_posts = JobPost::with('user','category')->where('user_id',$user->id)->latest()->paginate(5);
        $breadcrumb = BreadcrumbImage::where(['id' => 10])->first();

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

        $setting = Setting::first();
        $currency_icon = (object) array('icon' => $setting->currency_icon);
        $default_avatar = (object) array('image' => $setting->default_avatar);

        return view('jobpost::user.index', compact('job_posts','breadcrumb','user','active_theme','currency_icon','default_avatar'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        $user = Auth::guard('web')->user();

        $categories = Category::where('status', 1)->get();

        $cities = City::get();

        $breadcrumb = BreadcrumbImage::where(['id' => 10])->first();

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

        $setting = Setting::first();
        $currency_icon = (object) array('icon' => $setting->currency_icon);

        return view('jobpost::user.create', compact('categories', 'cities', 'user', 'active_theme', 'breadcrumb'));

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(JobPostRequest $request)
    {
        $user = Auth::guard('web')->user();
        $job_post = new JobPost();


        if($request->thumb_image){
            $image_name = 'jobpost'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $image_name ='uploads/custom-images/'.$image_name;
            Image::make($request->thumb_image)
                ->encode('webp', 80)
                ->save(public_path().'/'.$image_name);
            $job_post->thumb_image = $image_name;
        }

        $job_post->user_id = $user->id;
        $job_post->category_id = $request->category_id;
        $job_post->city_id = $request->city_id;
        $job_post->slug = $request->slug;
        $job_post->regular_price = $request->regular_price;
        $job_post->job_type = $request->job_type;
        $job_post->title = $request->title;
        $job_post->description = $request->description;
        $job_post->address = $request->address;
        $job_post->approved_by_admin = 'approved';
        $job_post->status = $request->status ? 'enable' : 'disable';
        $job_post->save();

        $notification= trans('user_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $user = Auth::guard('web')->user();
        $job_post = JobPost::findOrFail($id);
        $categories = Category::where('status', 1)->get();

        $cities = City::get();

        $breadcrumb = BreadcrumbImage::where(['id' => 10])->first();

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

        $setting = Setting::first();
        $currency_icon = (object) array('icon' => $setting->currency_icon);

        return view('jobpost::user.edit', compact('categories', 'cities', 'job_post', 'user', 'breadcrumb', 'active_theme'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(JobPostRequest $request, $id)
    {
        $job_post = JobPost::findOrFail($id);
        if($request->thumb_image){
            $old_image = $job_post->thumb_image;
            $image_name = 'jobpost'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $image_name ='uploads/custom-images/'.$image_name;
            Image::make($request->thumb_image)
                ->encode('webp', 80)
                ->save(public_path().'/'.$image_name);
            $job_post->thumb_image = $image_name;
            $job_post->save();

            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        $job_post->user_id = $request->user_id;
        $job_post->category_id = $request->category_id;
        $job_post->city_id = $request->city_id;
        $job_post->slug = $request->slug;
        $job_post->regular_price = $request->regular_price;
        $job_post->job_type = $request->job_type;
        $job_post->status = $request->status ? 'enable' : 'disable';
        $job_post->title = $request->title;
        $job_post->description = $request->description;
        $job_post->address = $request->address;
        $job_post->save();

        $notification= trans('user_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $jobpost = JobPost::findOrFail($id);
        $jobpost->delete();

        $notification=  trans('user_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function assign_language($lang_code){
        $jobpost_translates = JobPostTranslation::where('lang_code', admin_lang())->get();
        foreach($jobpost_translates as $jobpost_translate){
            $translate = new JobPostTranslation();
            $translate->job_post_id = $jobpost_translate->job_post_id;
            $translate->lang_code = $lang_code;
            $translate->title = $jobpost_translate->title;
            $translate->description = $jobpost_translate->description;
            $translate->address = $jobpost_translate->address;
            $translate->save();
        }
    }

    public function jobpost_approval($id){

        $job_post = JobPost::findOrFail($id);
        $job_post->approved_by_admin = 'approved';
        $job_post->status = 'enable';
        $job_post->save();

        $notification=  trans('user_validation.Apporval Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function job_post_applicants($id){

        $user = Auth::guard('web')->user();

        $breadcrumb = BreadcrumbImage::where(['id' => 10])->first();

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

        $setting = Setting::first();
        $currency_icon = (object) array('icon' => $setting->currency_icon);

        $job_post = JobPost::findOrFail($id);

        $job_requests = JobRequest::where('job_post_id', $id)->latest()->paginate(8);

        return view('jobpost::user.job_applicants', ['user' => $user, 'breadcrumb' => $breadcrumb, 'job_requests' => $job_requests,'setting' => $setting, 'currency_icon' => $currency_icon, 'active_theme' => $active_theme]);

    }

    public function job_application_approval($id){

        $job_request = JobRequest::findOrFail($id);

        $user = Auth::guard('web')->user();

        $approval_check = JobRequest::where('job_post_id', $job_request->job_post_id)->where('status', 'approved')->count();

        if($approval_check == 0){
            $job_request = JobRequest::findOrFail($id);
            $job_request->status = 'approved';
            $job_request->save();

            JobRequest::where('job_post_id', $job_request->job_post_id)->where('id', '!=', $id)->update(['status' => 'rejected']);

            $notification = trans('user_validation.Job assigned successfully');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->back()->with($notification);

        }else{
            $notification = trans('user_validation.Job already has assigned, so you can not assign again');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

    }

    public function job_application_delete($id){
        $job_request = JobRequest::findOrFail($id);
        $job_request->delete();

        $notification = trans('user_validation.Deleted successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

}
