<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\CountryState;
use App\Models\Country;
use Str;
use App\Models\User;
class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $cities=City::with('providers')->get();

        return view('admin.city', compact('cities'));
    }


    public function create()
    {
        $countries = Country::all();
        return view('admin.create_city', compact('countries'));
    }


    public function store(Request $request)
    {
        $rules = [
            'country'=>'required',
            'state'=>'required',
            'name'=>'required|unique:cities'
        ];

        $customMessages = [
            'country.required' => trans('admin_validation.Country is required'),
            'state.required' => trans('admin_validation.State is required'),
            'name.required' => trans('admin_validation.Service area is required'),
            'name.unique' => trans('admin_validation.Service area already exist'),
        ];
        $this->validate($request, $rules,$customMessages);

        $city=new City();
        $city->country_state_id=$request->state;
        $city->name=$request->name;
        $city->slug=Str::slug($request->name);
        $city->status=$request->status;
        $city->save();

        $notification=trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function edit($id)
    {
        $states = CountryState::all();
        $city = City::find($id);
        $countries = Country::all();
        return view('admin.edit_city', compact('states','city','countries'));
    }


    public function update(Request $request, $id)
    {
        $city = City::find($id);
        $rules = [
            'country'=>'required',
            'state'=>'required',
            'name'=>'required|unique:cities,name,'.$city->id
        ];
        $customMessages = [
            'country.required' => trans('admin_validation.Country is required'),
            'state.required' => trans('admin_validation.State is required'),
            'name.required' => trans('admin_validation.Service area is required'),
            'name.unique' => trans('admin_validation.Service area already exist'),
        ];
        $this->validate($request, $rules,$customMessages);

        $city->country_state_id=$request->state;
        $city->name=$request->name;
        $city->slug=Str::slug($request->name);
        $city->status=$request->status;
        $city->save();

        $notification=trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.city.index')->with($notification);
    }


    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();
        $notification=trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.city.index')->with($notification);
    }

    public function changeStatus($id){
        $city = City::find($id);
        if($city->status==1){
            $city->status=0;
            $city->save();
            $message=trans('admin_validation.Inactive Successfully');
        }else{
            $city->status=1;
            $city->save();
            $message=trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }

    public function stateByCountry($id){
        $states = CountryState::where(['status' => 1, 'country_id' => $id])->get();
        $response='<option value="">'.trans('admin_validation.Select').'</option>';
        if($states->count() > 0){
            foreach($states as $state){
                $response .= "<option value=".$state->id.">".$state->name."</option>";
            }
        }
        return response()->json(['states'=>$response]);
    }

    public function cityByState($id){
        $cities = City::where(['status' => 1, 'country_state_id' => $id])->get();
        $response='<option value="">'.trans('admin_validation.Select').'</option>';
        if($cities->count() > 0){
            foreach($cities as $city){
                $response .= "<option value=".$city->id.">".$city->name."</option>";
            }
        }
        return response()->json(['cities'=>$response]);
    }
}
