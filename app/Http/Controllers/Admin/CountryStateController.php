<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountryState;
use Str;
use App\Models\Country;
use App\Models\User;
class CountryStateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $states=CountryState::with('cities')->get();

        return view('admin.state', compact('states'));
    }


    public function create()
    {
        $countries=Country::all();
        return view('admin.create_state', compact('countries'));
    }


    public function store(Request $request)
    {
        $rules = [
            'country'=>'required',
            'name'=>'required|unique:country_states'
        ];
        $customMessages = [
            'country.required' => trans('admin_validation.Country is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'name.unique' => trans('admin_validation.Name already exist'),
        ];
        $this->validate($request, $rules,$customMessages);

        $state=new CountryState();
        $state->country_id=$request->country;
        $state->name=$request->name;
        $state->slug=Str::slug($request->name);
        $state->status=$request->status;
        $state->save();

        $notification=trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function edit($id)
    {
        $state = CountryState::find($id);
        $countries=Country::all();
        return view('admin.edit_state', compact('state','countries'));
    }


    public function update(Request $request, $id)
    {
        $state = CountryState::find($id);
        $rules = [
            'country'=>'required',
            'name'=>'required|unique:country_states,name,'.$state->id,
            'status' => 'required'
        ];
        $customMessages = [
            'country.required' => trans('admin_validation.Country is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'name.unique' => trans('admin_validation.Name already exist'),
        ];
        $this->validate($request, $rules,$customMessages);

        $state->country_id=$request->country;
        $state->name=$request->name;
        $state->slug=Str::slug($request->name);
        $state->status=$request->status;
        $state->save();

        $notification=trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.state.index')->with($notification);
    }


    public function destroy($id)
    {
        $state = CountryState::find($id);
        $state->delete();
        $notification=trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.state.index')->with($notification);
    }

    public function changeStatus($id){
        $state = CountryState::find($id);
        if($state->status==1){
            $state->status=0;
            $state->save();
            $message= trans('admin_validation.Inactive Successfully');
        }else{
            $state->status=1;
            $state->save();
            $message= trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }
}
