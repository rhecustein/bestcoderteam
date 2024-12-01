<?php

namespace Modules\Kyc\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Kyc\Entities\KycInformation;
use Modules\Kyc\Entities\KycType;
use Session, Auth, Image, File, Str ,Mail;
use App\Helpers\MailHelper;
use Modules\Kyc\Emails\KycVerifactionEmail;


class KycController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function kyc(){
        $influencer = Auth::guard('web')->user();

        $kyc = KycInformation::where(['user_id' => $influencer->id])->first();
        $kycType = KycType::orderBy('id', 'desc')->get();

        return view('kyc::User.kyc.index',compact('kyc','kycType'));
    }

    public function kycSubmit(Request $request){
        $influencer = Auth::guard('web')->user();
        $rules = [
            'kyc_id'=>'required',
            'file'=>'required',
        ];
        $customMessages = [
            'kyc_id.required' => trans('admin_validation.Type of is required'),
            'file' => trans('admin_validation.File is required'),
        ];

        $request->validate($rules,$customMessages);

        $kyc = new KycInformation();

        if($request->file){
            $extention = $request->file->getClientOriginalExtension();
            $image_name = 'document'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name = 'uploads/custom-images/'.$image_name;
            $request->file->move(public_path('uploads/custom-images/'),$image_name);
            $kyc->file = $image_name;
        }

        $kyc->kyc_id = $request->kyc_id;
        $kyc->user_id = $influencer->id;
        $kyc->message = $request->message;
        $kyc->status = 0;
        $kyc->save();

        $notification= trans('admin_validation.Information Submited Successfully. Pls Wait for Conformation');
        MailHelper::setMailConfig();

        $subject= trans('admin_validation.KYC Verifaction');
        $message = 'Name: ' . $influencer->name . '<br>' . $notification;

        Mail::to('rashed4pa@gmail.com')->send(new KycVerifactionEmail($message,$subject));

        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

}

