<?php

namespace Modules\Subscription\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use App\Models\Midtrans;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransController extends Controller
{
    private $order_id;
    private $expired_date;
    private $payment_url;
    public function __construct()
    {
        $midtrans = Midtrans::first();
        Config::$serverKey = $midtrans -> secret_key;
        Config::$isProduction = $midtrans -> account_mode == 'Sandbox' ? false : true;
        $this -> expired_date = now()->addHours(24)->format("Y-m-d H:i:s");
    }

    private function createPaymentLink(): array
    {
        

        $response = (array) Snap::createTransaction();
        return [
            "id"=>$order_id,
            "expired_date"=>$expired_date,
            "snap_token"=>$response["token"],
            "status"=>"pending",
            "amount"=>100,
            "payment_url"=>$response["redirect_url"]
        ];
    }

    public function payWithMidtrans($slug)
    {

    }

    public function webhook(Request $request)
    {

    }
}