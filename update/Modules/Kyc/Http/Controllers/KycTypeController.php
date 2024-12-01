<?php

namespace Modules\Kyc\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Kyc\Entities\KycType;
use Modules\Kyc\Entities\KycInformation;
use Session, Auth, Image, File, Str ,Mail;
use App\Helpers\MailHelper;
use Modules\Kyc\Emails\KycVerifactionEmail;
use App\Models\User;

class KycTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $kycType = KycType::orderBy('id', 'desc')->get();

        return view('kyc::Admin.Type.index',compact('kycType'));
    }

    public function store(Request $request){
        // $rules = [
        //     'name'=>'required',
        // ];
        // $customMessages = [
        //     'name.required' => trans('admin_validation.Name is required'),
        // ];

        // $this->validate($request, $rules, $customMessages);

        $kyctype = new KycType();
        $kyctype->name = $request->name;
        $kyctype->status = $request->status;
        $kyctype->save();

        $notification= trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function update(Request $request, $id){
        // $rules = [
        //     'name'=>'required',
        // ];
        // $customMessages = [
        //     'name.required' => trans('admin_validation.Name is required'),
        // ];

        // $this->validate($request, $rules, $customMessages);

        $kyc = KycType::find($id);
        $kyc->name = $request->name;
        $kyc->status = $request->status;
        $kyc->save();

        $notification= trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function destroy($id){
        $kyc = KycType::find($id);
        $kyc->delete();

        $notification= trans('admin_validation.Deleted Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function DestroyKyc($id){
        $kyc = KycInformation::find($id);
        $kyc->delete();

        $notification= trans('admin_validation.Deleted Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function UpdateKycStatus(Request $request, $id){

        $kyc = KycInformation::find($id);
        $kyc->status = $request->status;
        $kyc->save();

        $influencer = User::where('id',$kyc->user_id)->first();
        $influencer->kyc_status = $request->status;
        $influencer->save();
        
        $notification= trans('admin_validation.Updated Successfully');

        $notification2= trans('admin_validation.Your Account Is Verified By KYC');
        MailHelper::setMailConfig();

        $subject= trans('admin_validation.KYC Verifaction');
        $message = 'Name: ' . $influencer->name . '<br>' . $notification2;

        Mail::to($influencer->email)->send(new KycVerifactionEmail($message,$subject));

        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function kycList(){

       $kycs = KycInformation::orderBy('id', 'desc')->get();

        return view('kyc::Admin.kyc.index',compact('kycs'));
    }
}
