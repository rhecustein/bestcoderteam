<?php

namespace Modules\JobPost\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\JobPost\Entities\JobPost;
use Modules\JobPost\Entities\JobRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\City;
use App\Models\Setting;
use App\Models\Category;
use App\Models\BreadcrumbImage;

class FontendHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function jobList()
    {
        $cities = City::get();
        $job_posts = JobPost::with('user','category')->where('status','enable')->latest()->get();
        $job_categories = Category::where('status',1)->latest()->get();
        $setting = Setting::first();

        return response()->json([
            'job_posts' => $job_posts,
            'job_categories' => $job_categories,
            'cities' => $cities,
        ]);
    }

    public function SerchJob(Request $request)
    {
        // Extract search parameters from the request
        $key = $request->input('key');
        $location = $request->input('location');
        $category = $request->input('category');

        // Start building the query
        $query = JobPost::with('user', 'category');

        // Add conditions based on the search parameters
        if ($key) {
            $query->where('slug', 'like', '%' . $key . '%');
        }
        if ($location) {
            $query->where('city_id', $location);
        }
        if ($category) {
            $query->where('category_id', $category);
        }

        // Retrieve the job posts based on the search query
        $job_posts = $query->where('status', 'enable')->latest()->get();

        // Retrieve the cities
        $cities = City::get();

        // Retrieve the unique job categories
        $job_categories = JobPost::with('category')->latest()->get()->unique('category_id');

        $breadcrumb = BreadcrumbImage::where(['id' => 2])->first();

        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        return response()->json([
            'job_posts' => $job_posts,
            'job_categories' => $job_categories,
            'cities' => $cities,
            'currency_icon' => $currency_icon,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function JobDetils($slug)
    {
        $job_post = JobPost::where('slug',$slug)->latest()->first();
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        return response()->json([
            'job_post' => $job_post,
            'currency_icon' => $currency_icon,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function ApplyJob(Request $request)
    {
        $rules = [
            'resume' => 'required|mimes:pdf,doc,docx|max:2048',
        ];

        $customMessages = [
            'resume.required' => trans('user_validation.Resume is required'),
        ];

        $request->validate($rules,$customMessages);

        $auth_user = Auth::guard('api')->user();

        if($request->user_id == $auth_user->id){
            $notification = trans('user_validation.You can not applied to your own job post');
            return response()->json(['message' => $notification], 403);
        }

        $is_exist = JobRequest::where(['user_id' => $auth_user->id, 'job_post_id' => $request->job_id])->count();
        if($is_exist > 0){
            $notification = trans('user_validation.Application already submited');
            return response()->json(['message' => $notification], 403);
        }

        $approval_check = JobRequest::where('job_post_id', $request->job_id)->where('status', 'approved')->count();

        if($approval_check > 0){
            $notification = trans('user_validation.Job already has assigned, so you can not apply');
            return response()->json(['message' => $notification], 403);
        }

        // Validate the uploaded file
        if ($request->hasFile('resume')) {
            $pdfFile = $request->file('resume');
            $fileName = uniqid('pdf_') . '.' . $pdfFile->getClientOriginalExtension();
            $pdfFile->move(public_path('uploads/resume'), $fileName);
            // Save the file path in the database
            $resumePath = 'uploads/resume/' . $fileName;
        }

        $job_request = new JobRequest();
        $job_request->user_id = $auth_user->id;
        $job_request->seller_id = $request->user_id;
        $job_request->job_post_id = $request->job_id;
        $job_request->description = $request->message;
        $job_request->resume = $resumePath;
        $job_request->save();

        $notification = trans('user_validation.Your application has submited successfully, please wait for approval');
        return response()->json(['message' => $notification], 200);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('jobpost::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('jobpost::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
