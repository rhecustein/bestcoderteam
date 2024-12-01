<?php

namespace Modules\Kyc\Http\Controllers\API;

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
        $this->middleware('auth:api');
    }

    public function kyc(){
        $influencer = Auth::guard('api')->user();

        $kyc = KycInformation::where(['user_id' => $influencer->id])->first();
        $kycType = KycType::orderBy('id', 'desc')->get();

        return response()->json([
            'kyc' => $kyc,
            'kycType' => $kycType,
        ]);
    }

    public function kycSubmit(Request $request){

        $influencer = Auth::guard('api')->user();

        $rules = [
            'kyc_id'=>'required',
            'file'=>'required',
        ];
        $customMessages = [
           'kyc_id.required' => trans('admin_validation.Type of is required'),
           'file.required' => trans('admin_validation.File is required'),
        ];

        $request->validate($rules,$customMessages);

        $kyc = KycInformation::where(['user_id' => $influencer->id])->first();
        if($kyc){
            $notification= trans('admin_validation.KYC Information Submited Olredy');
            return response()->json(['message' => $notification], 403);
        }
       

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

        $influencer->kyc_status = 0;
        $influencer->save();



        $notification= trans('admin_validation.Information Submited Successfully. Pls Wait for Conformation');
        MailHelper::setMailConfig();

        $subject= trans('admin_validation.KYC Verifaction');
        $message = 'Name: ' . $influencer->name . '<br>' . $notification;

        Mail::to($influencer->email)->send(new KycVerifactionEmail($message,$subject));
        return response()->json(['message' => $notification], 403);

    }
}
