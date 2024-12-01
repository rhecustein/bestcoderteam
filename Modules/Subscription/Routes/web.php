<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



use Modules\Subscription\Http\Controllers\SubscriptionController as FrontendSubscriptionController;
use Admin\SubscriptionController;
use Modules\Subscription\Http\Controllers\Admin\PurchaseController;
use Modules\Subscription\Http\Controllers\Provider\PurchaseController as ProviderPurchaseController;
use Modules\Subscription\Http\Controllers\Provider\PaypalController;
use Modules\Subscription\Http\Controllers\User\PaypalController as UserPaypalController;
use Modules\Subscription\Http\Controllers\Provider\PaymentGatewayController;

use Modules\Subscription\Http\Controllers\User\PaymentController;

Route::middleware('demo')->group(function(){

    Route::get('subscription/plan', [FrontendSubscriptionController::class, 'subscription_plan'])->name('subscription-plan');

    Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){
        Route::resource('/subscription-plan', SubscriptionController::class);

        Route::get('/purchase-history',[PurchaseController::class, 'index'])->name('purchase-history');
        Route::get('/pending-plan-payment',[PurchaseController::class, 'pending_payment'])->name('pending-plan-payment');

        Route::get('/assign-plan',[PurchaseController::class, 'create'])->name('assign-plan');
        Route::post('/store-assign-plan',[PurchaseController::class, 'store'])->name('store-assign-plan');

        Route::get('/purchase-history-show/{id}',[PurchaseController::class, 'show'])->name('purchase-history-show');
        Route::put('/approved-plan-payment/{id}',[PurchaseController::class, 'approved_plan_payment'])->name('approved-plan-payment');
        Route::delete('/delete-plan-payment/{id}',[PurchaseController::class, 'delete_plan_payment'])->name('delete-plan-payment');

    });


    Route::group(['as'=> 'provider.', 'prefix' => 'provider'],function (){

        Route::get('/subscription-plan',[ProviderPurchaseController::class, 'subscription_plan'])->name('subscription-plan');

        Route::get('/subscription-payment/{id}',[ProviderPurchaseController::class, 'subscription_payment'])->name('subscription-payment');

        Route::group(['as'=> 'subscription.', 'prefix' => 'subscription'],function (){
            Route::get('/free-enroll/{id}',[ProviderPurchaseController::class, 'free_enroll'])->name('free-enroll');

            Route::post('/stripe-payment/{id}',[ProviderPurchaseController::class, 'stripe_payment'])->name('stripe-payment');

            Route::post('/razorpay-payment/{id}',[ProviderPurchaseController::class, 'razorpay_payment'])->name('razorpay-payment');
            Route::post('/flutterwave-payment',[ProviderPurchaseController::class, 'flutterwave_payment'])->name('flutterwave-payment');
            Route::post('/paystack-payment',[ProviderPurchaseController::class, 'paystack_payment'])->name('paystack-payment');

            Route::get('/mollie-payment/{id}',[ProviderPurchaseController::class, 'mollie_payment'])->name('mollie-payment');
            Route::get('/mollie-success-payment',[ProviderPurchaseController::class, 'mollie_success_payment'])->name('mollie-success-payment');

            Route::get('/instamojo-payment/{id}',[ProviderPurchaseController::class, 'instamojo_payment'])->name('instamojo-payment');
            Route::get('/instamojo-success-payment',[ProviderPurchaseController::class, 'instamojo_success_payment'])->name('instamojo-success-payment');

            Route::get('/paypal-payment/{id}',[PaypalController::class, 'paypal_payment'])->name('paypal-payment');
            Route::get('/paypal-success-payment',[PaypalController::class, 'paypal_success_payment'])->name('paypal-success-payment');
            Route::get('/paypal-faild-payment',[PaypalController::class, 'paypal_faild_payment'])->name('paypal-faild-payment');

            Route::post('/bank-payment/{id}',[ProviderPurchaseController::class, 'bank_payment'])->name('bank-payment');

            Route::get('/handcash-payment/{id}',[ProviderPurchaseController::class, 'handcash_payment'])->name('handcash-payment');

        });

        Route::get('/purchase-history',[ProviderPurchaseController::class, 'index'])->name('purchase-history');
        Route::get('/pending-plan-payment',[ProviderPurchaseController::class, 'pending_payment'])->name('pending-plan-payment');
        Route::get('/purchase-history-show/{id}',[ProviderPurchaseController::class, 'show'])->name('purchase-history-show');

        Route::get('/paypal-gateway',[PaymentGatewayController::class, 'paypal_gateway'])->name('paypal-gateway');
        Route::post('/store-paypal-gateway',[PaymentGatewayController::class, 'store_paypal_gateway'])->name('store-paypal-gateway');

        Route::get('/stripe-gateway',[PaymentGatewayController::class, 'stripe_gateway'])->name('stripe-gateway');
        Route::post('/store-stripe-gateway',[PaymentGatewayController::class, 'store_stripe_gateway'])->name('store-stripe-gateway');



        Route::get('/razorpay-gateway',[PaymentGatewayController::class, 'razorpay_gateway'])->name('razorpay-gateway');
        Route::post('/store-razorpay-gateway',[PaymentGatewayController::class, 'store_razorpay_gateway'])->name('store-razorpay-gateway');

        Route::get('/flutterwave-gateway',[PaymentGatewayController::class, 'flutterwave_gateway'])->name('flutterwave-gateway');
        Route::post('/store-flutterwave-gateway',[PaymentGatewayController::class, 'store_flutterwave_gateway'])->name('store-flutterwave-gateway');

        Route::get('/paystack-gateway',[PaymentGatewayController::class, 'paystack_gateway'])->name('paystack-gateway');
        Route::post('/store-paystack-gateway',[PaymentGatewayController::class, 'store_paystack_gateway'])->name('store-paystack-gateway');

        Route::get('/mollie-gateway',[PaymentGatewayController::class, 'mollie_gateway'])->name('mollie-gateway');
        Route::post('/store-mollie-gateway',[PaymentGatewayController::class, 'store_mollie_gateway'])->name('store-mollie-gateway');

        Route::get('/instamojo-gateway',[PaymentGatewayController::class, 'instamojo_gateway'])->name('instamojo-gateway');
        Route::post('/store-instamojo-gateway',[PaymentGatewayController::class, 'store_instamojo_gateway'])->name('store-instamojo-gateway');

        Route::get('/bank-handcash-gateway',[PaymentGatewayController::class, 'bank_handcash_gateway'])->name('bank-handcash-gateway');
        Route::post('/store-bank-handcash-gateway',[PaymentGatewayController::class, 'store_bank_handcash_gateway'])->name('store-bank-handcash-gateway');


        Route::get('manual/payments',[PaymentController::class, 'manualPayment'])->name('manual-payment');
        Route::get('manual/payments/{trx}',[PaymentController::class, 'manualPaymentDetails'])->name('manual.trx');
        Route::post('manual/payments/accept/{trx}',[PaymentController::class, 'manualPaymentAccept'])->name('manual.accept');
        Route::post('manual/payments/reject/{trx}',[PaymentController::class, 'manualPaymentReject'])->name('manual.reject');



    });


    Route::group(['as'=> 'user.', 'prefix' => 'user'],function (){
        Route::group(['as'=> 'sub.', 'prefix' => 'sub'],function (){

            Route::get('/payment/{slug}', [PaymentController::class, 'payment'])->name('payment');
            Route::post('/bank-payment/{slug}', [PaymentController::class, 'bankPayment'])->name('bank-payment');
            Route::get('/handcash-payment/{slug}', [PaymentController::class, 'handcash_payment'])->name('handcash-payment');

            Route::post('/pay-with-stripe/{slug}', [PaymentController::class, 'payWithStripe'])->name('pay-with-stripe');
            Route::post('/pay-with-razorpay/{slug}', [PaymentController::class, 'payWithRazorpay'])->name('pay-with-razorpay');
            Route::post('/pay-with-flutterwave/{slug}', [PaymentController::class, 'payWithFlutterwave'])->name('pay-with-flutterwave');
            Route::get('/pay-with-mollie/{slug}', [PaymentController::class, 'payWithMollie'])->name('pay-with-mollie');
            Route::get('/mollie-payment-success', [PaymentController::class, 'molliePaymentSuccess'])->name('mollie-payment-success');
            Route::get('/pay-with-paystack/{slug}', [PaymentController::class, 'payWithPayStack'])->name('pay-with-paystack');
            Route::get('/pay-with-instamojo/{slug}', [PaymentController::class, 'payWithInstamojo'])->name('pay-with-instamojo');
            Route::get('/response-instamojo', [PaymentController::class, 'instamojoResponse'])->name('response-instamojo');

            Route::get('/pay-with-paypal/{slug}', [UserPaypalController::class, 'payWithPaypal'])->name('pay-with-paypal');
            Route::get('/paypal-payment-success', [UserPaypalController::class, 'paypalPaymentSuccess'])->name('paypal-payment-success');
            Route::get('/paypal-payment-cancled', [UserPaypalController::class, 'paypalPaymentCancled'])->name('paypal-payment-cancled');


            // Route::get('/payment/{booking_id}',[PaymentController::class, 'payment'])->name('payment');

            // Route::post('/stripe-payment/{booking_id}',[PaymentController::class, 'stripe_payment'])->name('stripe-payment');
            // Route::post('/razorpay-payment/{booking_id}',[PaymentController::class, 'razorpay_payment'])->name('razorpay-payment');
            // Route::post('/flutterwave-payment',[PaymentController::class, 'flutterwave_payment'])->name('flutterwave-payment');
            // Route::post('/paystack-payment',[PaymentController::class, 'paystack_payment'])->name('paystack-payment');
            // Route::get('/mollie-payment/{booking_id}',[PaymentController::class, 'mollie_payment'])->name('mollie-payment');
            // Route::get('/mollie-success-payment',[PaymentController::class, 'mollie_payment_success'])->name('mollie-success-payment');
            // Route::get('/instamojo-payment/{booking_id}',[PaymentController::class, 'instamojo_payment'])->name('instamojo-payment');
            // Route::get('/instamojo-success-payment',[PaymentController::class, 'instamojo_payment_success'])->name('instamojo-success-payment');
            // Route::post('/bank-payment/{booking_id}',[PaymentController::class, 'bank_payment'])->name('bank-payment');
            // Route::get('/handcash-payment/{booking_id}',[PaymentController::class, 'handcash_payment'])->name('handcash-payment');


            // Route::get('/paypal-payment/{id}',[UserPaypalController::class, 'paypal_payment'])->name('paypal-payment');
            // Route::get('/paypal-success-payment',[UserPaypalController::class, 'paypal_success_payment'])->name('paypal-success-payment');
            // Route::get('/paypal-faild-payment',[UserPaypalController::class, 'paypal_faild_payment'])->name('paypal-faild-payment');


        });
    });

});
