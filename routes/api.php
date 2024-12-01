<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// provider start
use App\Http\Controllers\API\Provider\ProviderDashboardController;
use App\Http\Controllers\API\Provider\ProviderProfileController;
use App\Http\Controllers\API\Provider\ServiceController;
use App\Http\Controllers\API\Provider\ProviderTicketController;
use App\Http\Controllers\API\Provider\WithdrawController;
use App\Http\Controllers\API\Provider\ProviderOrderController;
use App\Http\Controllers\API\Provider\AppointmentScheduleController;
use App\Http\Controllers\API\Provider\MessageController;
// end provider

// frontend start
use App\Http\Controllers\API\HomeController;


use App\Http\Controllers\API\User\UserProfileController;
use App\Http\Controllers\API\User\PaymentController;
use App\Http\Controllers\User\PaypalController;

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\User\MessageController as UserMessageController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['demo','XSS']], function () {
    Route::group(['middleware' => ['maintainance']], function () {

        Route::get('/website-setup', [HomeController::class, 'website_setup'])->name('website-setup');
        Route::get('/download-file/{file}', [HomeController::class, 'downloadListingFile'])->name('download-file');

        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/join-as-a-provider', [HomeController::class, 'join_as_a_provider'])->name('join-as-a-provider');

        Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about-us');
        Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
        Route::post('/send-contact-message', [HomeController::class, 'sendContactMessage'])->name('send-contact-message');
        Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
        Route::get('/blog/{slug}', [HomeController::class, 'single_blog'])->name('blog');
        Route::post('/blog-comment', [HomeController::class, 'blogComment'])->name('blog-comment');
        Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
        Route::get('/terms-and-conditions', [HomeController::class, 'termsAndCondition'])->name('terms-and-conditions');
        Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');

        Route::get('/custom-page', [HomeController::class, 'customPages'])->name('custom-page');
        Route::get('/page/{slug}', [HomeController::class, 'customPage'])->name('page');
        Route::get('/services', [HomeController::class, 'services'])->name('services');
        Route::get('/service/{slug}', [HomeController::class, 'service'])->name('service');
        Route::get('/providers/{user_name}', [HomeController::class, 'provider'])->name('providers');
        Route::post('/store-service-review', [HomeController::class, 'storeServiceReview'])->name('store-service-review');

        Route::post('/subscribe-request', [HomeController::class, 'subscribeRequest'])->name('subscribe-request');
        Route::get('/subscriber-verification/{token}', [HomeController::class, 'subscriberVerifcation'])->name('subscriber-verification');

        Route::post('/request-provider', [HomeController::class, 'request_provider'])->name('request-provider');
        Route::post('/check-username', [HomeController::class, 'checkUserName'])->name('check-username');
        Route::get('state-by-country/{id}',[HomeController::class,'stateByCountry'])->name('state-by-country');
        Route::get('city-by-state/{id}',[HomeController::class,'cityByState'])->name('city-by-state');

        Route::post('/get-available-schedule', [PaymentController::class, 'get_available_schedule'])->name('get-available-schedule');


        Route::get('/ready-to-booking/{slug}', [PaymentController::class, 'ready_to_booking'])->name('ready-to-booking');

        Route::get('/check-schedule-during-payment/{slug}', [PaymentController::class, 'check_schedule_during_payment'])->name('check-schedule-during-payment');

        Route::get('/booking-information/{slug}', [PaymentController::class, 'booking_information'])->name('booking-information');
        Route::post('/payment/{slug}', [PaymentController::class, 'payment'])->name('payment');
        Route::post('/bank-payment/{slug}', [PaymentController::class, 'bankPayment'])->name('bank-payment');
        Route::post('/pay-with-stripe/{slug}', [PaymentController::class, 'payWithStripe'])->name('pay-with-stripe');

        Route::post('/pay-with-razorpay/{slug}', [PaymentController::class, 'payWithRazorpay'])->name('pay-with-razorpay');
        Route::post('/pay-with-flutterwave/{slug}', [PaymentController::class, 'payWithFlutterwave'])->name('pay-with-flutterwave');
        Route::get('/pay-with-mollie/{slug}', [PaymentController::class, 'payWithMollie'])->name('pay-with-mollie');
        Route::get('/mollie-payment-success', [PaymentController::class, 'molliePaymentSuccess'])->name('mollie-payment-success');
        Route::get('/pay-with-paystack/{slug}', [PaymentController::class, 'payWithPayStack'])->name('pay-with-paystack');
        Route::get('/pay-with-instamojo/{slug}', [PaymentController::class, 'payWithInstamojo'])->name('pay-with-instamojo');
        Route::get('/response-instamojo', [PaymentController::class, 'instamojoResponse'])->name('response-instamojo');

        Route::get('/pay-with-paypal/{slug}', [PaypalController::class, 'payWithPaypal'])->name('pay-with-paypal');
        Route::get('/paypal-payment-success', [PaypalController::class, 'paypalPaymentSuccess'])->name('paypal-payment-success');
        Route::get('/paypal-payment-cancled', [PaypalController::class, 'paypalPaymentCancled'])->name('paypal-payment-cancled');

        Route::get('/login-page', [LoginController::class, 'loginPage'])->name('login');
        Route::post('/store-login', [LoginController::class, 'storeLogin'])->name('store-login');
        Route::get('/register', [RegisterController::class, 'loginPage'])->name('register');
        Route::post('/store-register', [RegisterController::class, 'storeRegister'])->name('store-register');
        Route::get('/user-verification/{token}', [RegisterController::class, 'userVerification'])->name('user-verification');
        Route::post('/resend-register-code', [RegisterController::class, 'resendRegisterCode'])->name('resend-register-code');
        Route::get('/forget-password', [LoginController::class, 'forgetPage'])->name('forget-password');
        Route::post('/send-forget-password', [LoginController::class, 'sendForgetPassword'])->name('send-forget-password');
        Route::get('/reset-password/{token}', [LoginController::class, 'resetPasswordPage'])->name('reset-password');
        Route::post('/store-reset-password/{token}', [LoginController::class, 'storeResetPasswordPage'])->name('store-reset-password');

        Route::get('login/google',[LoginController::class, 'redirectToGoogle'])->name('login-google');
        Route::get('/callback/google',[LoginController::class,'googleCallBack'])->name('callback-google');

        Route::get('login/facebook',[LoginController::class, 'redirectToFacebook'])->name('login-facebook');
        Route::get('/callback/facebook',[LoginController::class,'facebookCallBack'])->name('callback-facebook');

        Route::get('dashboard', [UserProfileController::class, 'dashboard'])->name('dashboard');

        Route::get('/user/logout', [LoginController::class, 'userLogout'])->name('user.logout');
        Route::post('update-profile', [UserProfileController::class, 'updateProfile'])->name('update-profile');
        Route::post('update-password', [UserProfileController::class, 'updatePassword'])->name('update-password');
        Route::get('get-invoice/{id}', [UserProfileController::class, 'get_invoice'])->name('get-invoice');
        Route::get('mark-as-a-complete/{id}', [UserProfileController::class, 'mark_as_a_complete'])->name('mark-as-a-complete');
        Route::get('mark-as-a-declined/{id}', [UserProfileController::class, 'mark_as_a_declined'])->name('mark-as-a-declined');
        Route::post('send-refund-request', [UserProfileController::class, 'send_refund_request'])->name('send-refund-request');
        Route::post('ticket-request', [UserProfileController::class, 'ticket_request'])->name('ticket-request');
        Route::get('show-ticket/{id}', [UserProfileController::class, 'show_ticket'])->name('show-ticket');
        Route::post('send-ticket-message', [UserProfileController::class, 'send_ticket_message'])->name('send-ticket-message');
        
        Route::get('live-chat', [UserMessageController::class, 'index'])->name('live-chat');
        Route::get('load-chat-box/{id}', [UserMessageController::class, 'load_chat_box'])->name('load-chat-box');
        Route::post('send-message-to-provider', [UserMessageController::class, 'send_message_to_provider'])->name('send-message-to-provider');

        Route::group(['as'=> 'provider.', 'prefix' => 'provider','middleware' => ['auth:api']],function (){
            Route::get('dashboard',[ProviderDashboardController::class,'index'])->name('dashboard');
            Route::get('my-profile',[ProviderProfileController::class,'index'])->name('my-profile');
            Route::get('state-by-country/{id}',[ProviderProfileController::class,'stateByCountry'])->name('state-by-country');
            Route::get('city-by-state/{id}',[ProviderProfileController::class,'cityByState'])->name('city-by-state');
            Route::get('change-password',[ProviderProfileController::class,'changePassword'])->name('change-password');
            Route::put('password-update',[ProviderProfileController::class,'updatePassword'])->name('password-update');
            Route::post('update-provider-profile',[ProviderProfileController::class,'updateSellerProfile'])->name('update-provider-profile');

            Route::resource('my-withdraw', WithdrawController::class);
            Route::get('get-withdraw-account-info/{id}', [WithdrawController::class, 'getWithDrawAccountInfo'])->name('get-withdraw-account-info');

            Route::resource('service', ServiceController::class);
            Route::post('service-update/{id}', [ServiceController::class, 'update'])->name('service-update');

            Route::get('review-list', [ServiceController::class, 'reviewList'])->name('review-list');
            Route::get('show-review/{id}', [ServiceController::class, 'showReview'])->name('show-review');
            Route::get('awaiting-for-approval-service', [ServiceController::class, 'awaitingForApproval'])->name('awaiting-for-approval-service');
            Route::get('active-service', [ServiceController::class, 'activeService'])->name('active-service');
            Route::get('banned-service', [ServiceController::class, 'bannedService'])->name('banned-service');

            Route::get('schedule',[ProviderProfileController::class,'schedule'])->name('schedule');
            Route::put('update-schedule',[ProviderProfileController::class,'updateSchedule'])->name('update-schedule');

            Route::resource('appointment-schedule',AppointmentScheduleController::class);

            Route::get('ticket', [ProviderTicketController::class, 'index'])->name('ticket');
            Route::get('ticket-show/{id}', [ProviderTicketController::class, 'show'])->name('ticket-show');
            Route::post('store-ticket-message', [ProviderTicketController::class, 'storeMessage'])->name('store-ticket-message');
            Route::get('create-new-ticket', [ProviderTicketController::class, 'createNewTicket'])->name('create-new-ticket');
            Route::post('store-new-ticket', [ProviderTicketController::class, 'storeNewTicket'])->name('store-new-ticket');

            Route::get('all-booking', [ProviderOrderController::class, 'index'])->name('all-booking');
            Route::get('awaiting-booking', [ProviderOrderController::class, 'awaitingBooking'])->name('awaiting-booking');
            Route::get('active-booking', [ProviderOrderController::class, 'activeBooking'])->name('active-booking');
            Route::get('completed-booking', [ProviderOrderController::class, 'completeBooking'])->name('completed-booking');
            Route::get('declined-booking', [ProviderOrderController::class, 'declineBooking'])->name('declined-booking');
            Route::put('booking-declined/{id}', [ProviderOrderController::class, 'bookingDecilendRequest'])->name('booking-declined');
            Route::put('booking-approved/{id}', [ProviderOrderController::class, 'bookingApprovedRequest'])->name('booking-approved');
            Route::get('booking-show/{id}', [ProviderOrderController::class, 'show'])->name('booking-show');

            Route::get('complete-request', [ProviderOrderController::class, 'completeRequest'])->name('complete-request');
            Route::post('send-order-complete-request', [ProviderOrderController::class, 'sendCompleteRequest'])->name('send-order-complete-request');
            
            Route::get('live-chat', [MessageController::class, 'index'])->name('live-chat');
            Route::get('load-chat-box/{id}', [MessageController::class, 'load_chat_box'])->name('load-chat-box');
            Route::post('send-message-to-buyer', [MessageController::class, 'send_message_to_buyer'])->name('send-message-to-buyer');

            Route::get('find-new-buyer/{id}', [MessageController::class, 'find_new_buyer'])->name('find-new-buyer');

        });
    });
});
