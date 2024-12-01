<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;
use  Image;
use File;
use Str;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::with('service')->get();

        $setting = Setting::first();
        $selected_theme = $setting->selected_theme;

        return view('admin.category',compact('categories','selected_theme'));
    }


    public function create()
    {
        $setting = Setting::first();
        $selected_theme = $setting->selected_theme;

        return view('admin.create_product_category', compact('selected_theme'));
    }


    public function store(Request $request)
    {

        $setting = Setting::first();
        $selected_theme = $setting->selected_theme;

        $rules = [
            'name'=>'required|unique:categories',
            'slug'=>'required|unique:categories',
            'status'=>'required',
            'icon'=>'required',
            'image'=> $selected_theme == 0 || $selected_theme == 3 ? 'required' : '',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'name.unique' => trans('admin_validation.Name already exist'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            'icon.required' => trans('admin_validation.Icon is required'),
            'image.required' => trans('admin_validation.Image is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $category = new Category();
        if($request->icon){
            $extention = $request->icon->getClientOriginalExtension();
            $logo_name = 'category'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $logo_name = 'uploads/custom-images/'.$logo_name;
            Image::make($request->icon)
                ->save(public_path().'/'.$logo_name);
            $category->icon=$logo_name;
        }

        if($request->image){
            $extention = $request->image->getClientOriginalExtension();
            $logo_name = 'category'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $logo_name = 'uploads/custom-images/'.$logo_name;
            Image::make($request->image)
                ->save(public_path().'/'.$logo_name);
            $category->image=$logo_name;
        }


        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->save();

        $notification = trans('admin_validation.Created Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.category.index')->with($notification);
    }

    public function edit($id)
    {
        $category = Category::find($id);

        $setting = Setting::first();
        $selected_theme = $setting->selected_theme;

        return view('admin.edit_category',compact('category','selected_theme'));
    }


    public function update(Request $request,$id)
    {
        $category = Category::find($id);
        $rules = [
            'name'=>'required|unique:categories,name,'.$category->id,
            'slug'=>'required|unique:categories,name,'.$category->id,
            'status'=>'required',
        ];

        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'name.unique' => trans('admin_validation.Name already exist'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
        ];
        $this->validate($request, $rules,$customMessages);

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->save();
        if($request->icon){
            $old_logo = $category->icon;
            $extention = $request->icon->getClientOriginalExtension();
            $logo_name = 'category'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $logo_name = 'uploads/custom-images/'.$logo_name;
            Image::make($request->icon)
                ->save(public_path().'/'.$logo_name);
            $category->icon=$logo_name;
            $category->save();
            if($old_logo){
                if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
            }
        }

        if($request->image){
            $old_logo = $category->image;
            $extention = $request->image->getClientOriginalExtension();
            $logo_name = 'category'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $logo_name = 'uploads/custom-images/'.$logo_name;
            Image::make($request->image)
                ->save(public_path().'/'.$logo_name);
            $category->image=$logo_name;
            $category->save();
            if($old_logo){
                if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
            }
        }




        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.category.index')->with($notification);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $old_logo = $category->icon;
        $old_image = $category->image;
        $category->delete();
        if($old_logo){
            if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
        }
        if($old_image){
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
        }






        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.category.index')->with($notification);
    }

    public function changeStatus($id){
        $category = Category::find($id);
        if($category->status==1){
            $category->status=0;
            $category->save();
            $message = trans('admin_validation.Inactive Successfully');
        }else{
            $category->status=1;
            $category->save();
            $message= trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }
}
