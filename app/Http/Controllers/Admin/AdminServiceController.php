<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Category;
use App\Models\Service;
use App\Models\AdditionalService;
use App\Models\Setting;
use App\Models\Order;
use App\Models\User;
use Auth;
use Image;
use File;

use Illuminate\Pagination\Paginator;

class AdminServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        Paginator::useBootstrap();
        $services = Service::with('category','provider','orders')->orderBy('id', 'desc');

        if($request->provider){
            $services = $services->where('provider_id', $request->provider);
        }


        $services = $services->paginate(15);

        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;
        $title = trans('admin_validation.All Service');

        $providers = User::where(['status' => 1, 'is_provider' => 1])->orderBy('name','asc')->get();

        return view('admin.service', compact('services','currency_icon','title','providers'));
    }


    public function awaitingForApproval(Request $request){
        Paginator::useBootstrap();
        $services = Service::with('category','provider')->where('approve_by_admin',0)->orderBy('id', 'desc')->paginate(15);
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;
        $title = trans('admin_validation.Awaiting for Approval');
        $providers = User::where(['status' => 1, 'is_provider' => 1])->orderBy('name','asc')->get();

        return view('admin.service', compact('services','currency_icon','title','providers'));
    }

    public function activeService(Request $request){
        Paginator::useBootstrap();
        $services = Service::with('category','provider')->where('approve_by_admin',1)->where('status',1)->orderBy('id', 'desc')->paginate(15);
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;
        $title = trans('admin_validation.Active Service');
        $providers = User::where(['status' => 1, 'is_provider' => 1])->orderBy('name','asc')->get();

        return view('admin.service', compact('services','currency_icon','title','providers'));
    }

    public function bannedService(Request $request){
        Paginator::useBootstrap();
        $services = Service::with('category','provider')->where('is_banned',1)->orderBy('id', 'desc')->paginate(15);
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;
        $title = trans('admin_validation.Banned Service');
        $providers = User::where(['status' => 1, 'is_provider' => 1])->orderBy('name','asc')->get();

        return view('admin.service', compact('services','currency_icon','title','providers'));
    }

    public function create(){
        $categories = Category::where('status', 1)->get();
        $providers = User::where('is_provider',1)->orderBy('name','asc')->select('id','name','email')->get();

        return view('admin.create_service', compact('categories','providers'));
    }

    public function store(Request $request){
        $rules = [
            'name'=>'required',
            'slug'=>'required|unique:services',
            'price'=>'required',
            'category_id'=>'required',
            'details'=>'required',
            'image'=>'required',
            'provider_id'=>'required',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            'price.required' => trans('admin_validation.Price is required'),
            'category_id.required' => trans('admin_validation.Category is required'),
            'details.required' => trans('admin_validation.Details is required'),
            'image.required' => trans('admin_validation.Image is required'),
            'provider_id.required' => trans('admin_validation.Provider is required'),
        ];
        $this->validate($request, $rules,$customMessages);
        $user = Auth::guard('web')->user();
        $service = new Service();
        if($request->file('image')){
            $user_image = $request->image;
            $extention = $user_image->getClientOriginalExtension();
            $image_name= 'Service'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/custom-images/'.$image_name;
            Image::make($user_image)
                ->save(public_path().'/'.$image_name);
            $service->image=$image_name;
        }

        $package_features = array();
        $is_pacakge_feature = false;
        foreach($request->package_features as $package_feature){
            if($package_feature){
                $package_features[] = $package_feature;
                $is_pacakge_feature = true;
            }
        }
        $package_features = json_encode($package_features);

        $what_you_will_provides = array();
        $is_what_you_will_provide = false;
        foreach($request->what_you_will_provides as $what_you_will_provide){
            if($what_you_will_provide){
                $is_what_you_will_provide = true;
                $what_you_will_provides[] = $what_you_will_provide;
            }
        }
        $what_you_will_provides = json_encode($what_you_will_provides);

        $benifits = array();
        $is_benifit = false;
        foreach($request->benifits as $benifit){
            if($benifit){
                $benifits[] = $benifit;
                $is_benifit = true;
            }

        }
        $benifits = json_encode($benifits);

        $service->provider_id = $request->provider_id;
        $service->category_id = $request->category_id;
        $service->name = $request->name;
        $service->slug = $request->slug;
        $service->price = $request->price;
        $service->details = $request->details;
        $service->seo_title = $request->seo_title ? $request->seo_title : $request->name;
        $service->seo_description = $request->seo_description ? $request->seo_description : $request->name;
        $service->status = 0;
        $service->package_features = $is_pacakge_feature ? $package_features : '';
        $service->what_you_will_provide = $is_what_you_will_provide ?  $what_you_will_provides : '';
        $service->benifit = $is_benifit ? $benifits : '';
        $service->approve_by_admin = 1;
        $service->status = 1;
        $service->save();


        if(count($request->additional_services) > 0 && count($request->additional_quantities) > 0 && count($request->additional_prices) > 0){
            if($request->additional_feature_images){
                foreach($request->additional_feature_images as $index => $additional_feature_image){
                    if($request->additional_services[$index] && $request->additional_quantities[$index] && $request->additional_prices[$index]){
                        $additional_service = new AdditionalService();
                        $service_image = $additional_feature_image;
                        $extention = $service_image->getClientOriginalExtension();
                        $image_name= 'service-add'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
                        $image_name='uploads/custom-images/'.$image_name;
                        Image::make($service_image)
                            ->save(public_path().'/'.$image_name);
                        $additional_service->image = $image_name;
                        $additional_service->service_name = $request->additional_services[$index];
                        $additional_service->qty = $request->additional_quantities[$index];
                        $additional_service->price = $request->additional_prices[$index];
                        $additional_service->service_id = $service->id;
                        $additional_service->save();
                    }
                }
            }
        }

        $notification= trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.service.index')->with($notification);
    }

    public function edit($id){
        $categories = Category::where('status', 1)->get();
        $service = Service::find($id);

        $package_features = array();
        if($service->package_features){
            $features = json_decode($service->package_features);
            foreach($features as $feature){
                $package_features [] = $feature;
            }
        }

        $what_you_will_provides = array();
        if($service->what_you_will_provide){
            $provides = json_decode($service->what_you_will_provide);
            foreach($provides as $provide){
                $what_you_will_provides [] = $provide;
            }
        }

        $benifits = array();
        if($service->benifit){
            $exist_benifits = json_decode($service->benifit);
            foreach($exist_benifits as $exist_benifit){
                $benifits [] = $exist_benifit;
            }
        }

        $additional_services = AdditionalService::where('service_id', $id)->get();
        $providers = User::where('is_provider',1)->orderBy('name','asc')->select('id','name','email')->get();

        return view('admin.edit_service', compact('categories','service','package_features','what_you_will_provides','benifits','additional_services','providers'));
    }

    public function update(Request $request, $id){

        $service = Service::find($id);
        $rules = [
            'name'=>'required',
            'slug'=>'required|unique:services,slug,'. $service->id,
            'price'=>'required',
            'category_id'=>'required',
            'details'=>'required',
            'provider_id'=>'required',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            'price.required' => trans('admin_validation.Price is required'),
            'category_id.required' => trans('admin_validation.Category is required'),
            'details.required' => trans('admin_validation.Details is required'),
            'provider_id.required' => trans('admin_validation.Details is required'),
        ];
        $this->validate($request, $rules,$customMessages);
        if($request->file('image')){
            $old_image = $service->image;
            $user_image = $request->image;
            $extention = $user_image->getClientOriginalExtension();
            $image_name= 'Service'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/custom-images/'.$image_name;
            Image::make($user_image)
                ->save(public_path().'/'.$image_name);
            $service->image=$image_name;
            $service->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        $package_features = array();
        $is_pacakge_feature = false;
        foreach($request->package_features as $package_feature){
            if($package_feature){
                $package_features[] = $package_feature;
                $is_pacakge_feature = true;
            }
        }
        $package_features = json_encode($package_features);

        $what_you_will_provides = array();
        $is_what_you_will_provide = false;
        foreach($request->what_you_will_provides as $what_you_will_provide){
            if($what_you_will_provide){
                $is_what_you_will_provide = true;
                $what_you_will_provides[] = $what_you_will_provide;
            }
        }
        $what_you_will_provides = json_encode($what_you_will_provides);

        $benifits = array();
        $is_benifit = false;
        foreach($request->benifits as $benifit){
            if($benifit){
                $benifits[] = $benifit;
                $is_benifit = true;
            }

        }
        $benifits = json_encode($benifits);

        $service->provider_id = $request->provider_id;
        $service->category_id = $request->category_id;
        $service->name = $request->name;
        $service->slug = $request->slug;
        $service->price = $request->price;
        $service->details = $request->details;
        $service->seo_title = $request->seo_title ? $request->seo_title : $request->name;
        $service->seo_description = $request->seo_description ? $request->seo_description : $request->name;
        $service->package_features = $is_pacakge_feature ? $package_features : '';
        $service->what_you_will_provide = $is_what_you_will_provide ?  $what_you_will_provides : '';
        $service->benifit = $is_benifit ? $benifits : '';
        if($service->approve_by_admin == 0){
            $service->approve_by_admin = $request->approved;
        }
        if($service->approve_by_admin == 1){
            $service->make_featured = $request->featured;
            $service->make_popular = $request->popular;
            $service->is_banned = $request->banned;
        }
        $service->save();

        if($request->ids){
            $not_in_array = array();
            foreach($request->ids as $exist_index => $id){
                if($request->ids[$exist_index] && $request->exist_additional_services[$exist_index] && $request->exist_additional_quantities[$exist_index] && $request->exist_additional_prices[$exist_index]){
                    $additional_service = AdditionalService::find($id);
                    $additional_service->service_name = $request->exist_additional_services[$exist_index];
                    $additional_service->qty = $request->exist_additional_quantities[$exist_index];
                    $additional_service->price = $request->exist_additional_prices[$exist_index];
                    $additional_service->save();

                    $ex_name = 'exist_additional_feature_image_'.$id;
                    $request_exist_image = $request->$ex_name;

                    if($request_exist_image){
                        $exist_image = $additional_service->image;
                        $service_image = $request_exist_image;
                        $extention = $service_image->getClientOriginalExtension();
                        $image_name= 'service-add'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
                        $image_name='uploads/custom-images/'.$image_name;
                        Image::make($service_image)
                            ->save(public_path().'/'.$image_name);
                        $additional_service->image = $image_name;
                        $additional_service->save();
                        if($exist_image){
                            if(File::exists(public_path().'/'.$exist_image))unlink(public_path().'/'.$exist_image);
                        }
                    }

                }
                $not_in_array[] = $id;
            }

            $not_in_additional_services = AdditionalService::whereNotIn('id', $not_in_array)->where('service_id', $service->id)->get();

            foreach($not_in_additional_services as $not_in_additional_service){
                $exist_image = $not_in_additional_service->image;
                $not_in_additional_service->delete();
                if($exist_image){
                    if(File::exists(public_path().'/'.$exist_image))unlink(public_path().'/'.$exist_image);
                }
            }

        }else{
            $additional_services = AdditionalService::where('service_id', $id)->get();
            foreach($additional_services as $additional_service){
                $exist_image = $additional_service->image;
                $additional_service->delete();
                if($exist_image){
                    if(File::exists(public_path().'/'.$exist_image))unlink(public_path().'/'.$exist_image);
                }
            }
        }

        if(count($request->additional_services) > 0 && count($request->additional_quantities) > 0 && count($request->additional_prices) > 0){
            if($request->additional_feature_images){
                foreach($request->additional_feature_images as $index => $additional_feature_image){
                    if($request->additional_services[$index] && $request->additional_quantities[$index] && $request->additional_prices[$index]){
                        $additional_service = new AdditionalService();
                        $service_image = $additional_feature_image;
                        $extention = $service_image->getClientOriginalExtension();
                        $image_name= 'service-add'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
                        $image_name='uploads/custom-images/'.$image_name;
                        Image::make($service_image)
                            ->save(public_path().'/'.$image_name);
                        $additional_service->image = $image_name;
                        $additional_service->service_name = $request->additional_services[$index];
                        $additional_service->qty = $request->additional_quantities[$index];
                        $additional_service->price = $request->additional_prices[$index];
                        $additional_service->service_id = $service->id;
                        $additional_service->save();
                    }
                }
            }
        }


        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.service.index')->with($notification);
    }

    public function destroy($id){
        $service = Service::find($id);

        $additional_services = AdditionalService::where('service_id', $id)->get();
        foreach($additional_services as $additional_service){
            $exist_image = $additional_service->image;
            $additional_service->delete();
            if($exist_image){
                if(File::exists(public_path().'/'.$exist_image))unlink(public_path().'/'.$exist_image);
            }
        }
        $old_image=$service->image;
        $service->delete();
        if($old_image){
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
        }
        Review::where('service_id', $id)->delete();

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.service.index')->with($notification);

    }

    public function reviewList(Request $request){
        $reviews = Review::with('user','service')->orderBy('id','desc')->get();

        if($request->provider_id){
            $reviews = $reviews->where('provider_id', $request->provider_id);
        }

        return view('admin.review', compact('reviews'));
    }

    public function showReview($id){
        $review = Review::with('user','service','provider')->orderBy('id','desc')->where('id', $id)->first();

        return view('admin.show_review', compact('review'));
    }

    public function deleteReview($id){
        $review = Review::find($id);
        $review->delete();

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.review-list')->with($notification);
    }


    public function updateReview(Request $request, $id){
        $review = Review::find($id);
        $review->status = $request->status;
        $review->save();

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
