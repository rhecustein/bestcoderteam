<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuVisibility;
class MenuVisibilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $menus = MenuVisibility::all();
        return view('admin.menu_visibility', compact('menus'));
    }

    public function update(Request $request){

        foreach($request->ids as $index => $id){
            $menu = MenuVisibility::find($id);
            $menu->custom_name = $request->custom_names[$index];
            $menu->status = $request->status[$index];
            $menu->save();
        }

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
