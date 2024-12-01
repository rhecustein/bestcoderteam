<?php
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\EmailConfigurationController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogCommentController;
use App\Http\Controllers\Admin\PopularBlogController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\CustomPageController;
use App\Http\Controllers\Admin\TermsAndConditionController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\FooterSocialLinkController;
use App\Http\Controllers\Admin\FooterLinkController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\MobileSliderController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ErrorPageController;
use App\Http\Controllers\Admin\WithdrawMethodController;
use App\Http\Controllers\Admin\ProviderWithdrawController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CountryStateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\BreadcrumbController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;



use App\Http\Controllers\Admin\DashboardController;



use App\Http\Controllers\Admin\MenuVisibilityController;



use App\Http\Controllers\Provider\ProviderDashboardController;
use App\Http\Controllers\Provider\ProviderProfileController;
use App\Http\Controllers\Provider\ServiceController;
use App\Http\Controllers\Provider\ProviderTicketController;
use App\Http\Controllers\Provider\WithdrawController;
use App\Http\Controllers\Provider\ProviderOrderController;
use App\Http\Controllers\Provider\AppointmentScheduleController;
use App\Http\Controllers\Provider\CouponController;
use App\Http\Controllers\Provider\MessageController;


// frontend start

use App\Http\Controllers\HomeController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\MessageController as UserMessageController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\API\User\PaymentController as ApiPaymentController;
use App\Http\Controllers\User\PaypalController;
use App\Http\Controllers\API\User\PaypalController as ApiPaypalController;



use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


Broadcast::routes(['middleware' => 'auth:web']);

// Broadcast::routes(['prefix' => 'provider', 'middleware' => 'auth:web']);

// Broadcast::routes(['prefix' => 'provider','middleware' => 'auth:web']);

// Broadcast::routes(['prefix' => 'api', 'middleware' => 'auth:api']);

Route::group(['middleware' => ['demo','XSS']], function () {

Route::group(['middleware' => ['maintainance']], function () {

    Route::group(['middleware' => ['HtmlSpecialchars']], function () {

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

    Route::get('/check-provider-schedule', [PaymentController::class, 'check_provider_schedule'])->name('check-provider-schedule');

    Route::get('/ready-to-booking/{slug}', [PaymentController::class, 'ready_to_booking'])->name('ready-to-booking');

    Route::get('/get-available-schedule', [PaymentController::class, 'get_available_schedule'])->name('get-available-schedule');

    Route::get('/check-schedule-during-payment/{slug}', [PaymentController::class, 'check_schedule_during_payment'])->name('check-schedule-during-payment');

    Route::get('/apply-coupon', [PaymentController::class, 'apply_coupon'])->name('apply-coupon');


    Route::get('/booking-information/{slug}', [PaymentController::class, 'booking_information'])->name('booking-information');
    Route::get('/payment/{slug}', [PaymentController::class, 'payment'])->name('payment');
    Route::post('/bank-payment/{slug}', [PaymentController::class, 'bankPayment'])->name('bank-payment');
    Route::post('/pay-with-stripe/{slug}', [PaymentController::class, 'payWithStripe'])->name('pay-with-stripe');
    Route::post('/pay-with-razorpay/{slug}', [PaymentController::class, 'payWithRazorpay'])->name('pay-with-razorpay');
    Route::post('/pay-with-flutterwave/{slug}', [PaymentController::class, 'payWithFlutterwave'])->name('pay-with-flutterwave');
    Route::get('/pay-with-mollie/{slug}', [PaymentController::class, 'payWithMollie'])->name('pay-with-mollie');
    Route::get('/mollie-payment-success', [PaymentController::class, 'molliePaymentSuccess'])->name('mollie-payment-success');
    Route::get('/pay-with-paystack/{slug}', [PaymentController::class, 'payWithPayStack'])->name('pay-with-paystack');
    Route::get('/pay-with-instamojo/{slug}', [PaymentController::class, 'payWithInstamojo'])->name('pay-with-instamojo');
    Route::get('/response-instamojo', [PaymentController::class, 'instamojoResponse'])->name('response-instamojo');

    // webview route
    Route::post('/razorpay-create-token', [ApiPaymentController::class, 'razorpay_create_token'])->name('razorpay-create-token');
    Route::get('/razorpay-webview', [ApiPaymentController::class, 'razorpay_web_view'])->name('razorpay-webview');
    Route::get('/webview-schedule-not-available', [ApiPaymentController::class, 'webview_schedule_not_available'])->name('webview-schedule-not-available');
    Route::post('/webview-razorpay-payment-verify', [ApiPaymentController::class, 'webview_razorpay_payment_verify'])->name('webview-razorpay-payment-verify');
    Route::get('/webview-payment-faild', [ApiPaymentController::class, 'webview_payment_faild'])->name('webview-payment-faild');
    Route::get('/webview-payment-success', [ApiPaymentController::class, 'webview_payment_success'])->name('webview-payment-success');


    Route::get('/flutterwave-webview', [ApiPaymentController::class, 'flutterwave_web_view'])->name('flutterwave-webview');
    Route::post('/pay-with-flutterwave-webview', [ApiPaymentController::class, 'pay_with_flutterwave_web_view'])->name('pay-with-flutterwave-webview');


    Route::get('/pay-with-mollie-webview', [ApiPaymentController::class, 'pay_with_mollie_webview'])->name('pay-with-mollie-webview');
    Route::get('/mollie-payment-success-webview', [ApiPaymentController::class, 'mollie_payment_success'])->name('mollie-payment-success-webview');

    Route::get('/paystack-web-view', [ApiPaymentController::class, 'paystack_web_view'])->name('paystack-web-view');
    Route::post('/pay-with-paystack-webview', [ApiPaymentController::class, 'pay_with_paystack'])->name('pay-with-paystack-webview');


    Route::get('/pay-with-instamojo-webview', [ApiPaymentController::class, 'pay_with_instamojo'])->name('pay-with-instamojo-webview');

    Route::get('/instamojo-response-webview', [ApiPaymentController::class, 'instamojo_response'])->name('instamojo-response-webview');

    Route::get('/paypal-web-view', [ApiPaypalController::class, 'paypal_web_view'])->name('paypal-web-view');

    Route::get('/pay-with-paypal-webview', [ApiPaypalController::class, 'payWithPaypal'])->name('pay-with-paypal-webview');

    Route::get('/paypal-payment-success-webview', [ApiPaypalController::class, 'paypalPaymentSuccess'])->name('paypal-payment-success-webview');
    Route::get('/paypal-payment-cancled-webview', [ApiPaypalController::class, 'paypalPaymentCancled'])->name('paypal-payment-cancled-webview');

    Route::get('/pay-with-paypal/{slug}', [PaypalController::class, 'payWithPaypal'])->name('pay-with-paypal');
    Route::get('/paypal-payment-success', [PaypalController::class, 'paypalPaymentSuccess'])->name('paypal-payment-success');
    Route::get('/paypal-payment-cancled', [PaypalController::class, 'paypalPaymentCancled'])->name('paypal-payment-cancled');

    Route::get('/login', [LoginController::class, 'loginPage'])->name('login');
    Route::post('/store-login', [LoginController::class, 'storeLogin'])->name('store-login');
    Route::get('/register', [RegisterController::class, 'loginPage'])->name('register');
    Route::post('/store-register', [RegisterController::class, 'storeRegister'])->name('store-register');
    Route::get('/user-verification/{token}', [RegisterController::class, 'userVerification'])->name('user-verification');
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
    Route::get('/user/delete-account', [UserProfileController::class, 'delete_account'])->name('user.delete-account');
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

    });

    Route::group(['as'=> 'provider.', 'prefix' => 'provider','middleware' => ['auth:web','checkprovider']],function (){
        Route::get('dashboard',[ProviderDashboardController::class,'index'])->name('dashboard');
        Route::get('my-profile',[ProviderProfileController::class,'index'])->name('my-profile');
        Route::get('state-by-country/{id}',[ProviderProfileController::class,'stateByCountry'])->name('state-by-country');
        Route::get('city-by-state/{id}',[ProviderProfileController::class,'cityByState'])->name('city-by-state');
        Route::get('change-password',[ProviderProfileController::class,'changePassword'])->name('change-password');
        Route::put('password-update',[ProviderProfileController::class,'updatePassword'])->name('password-update');
        Route::put('update-provider-profile',[ProviderProfileController::class,'updateSellerProfile'])->name('update-provider-profile');

        Route::get('export-service-area/{state_id}',[ProviderProfileController::class,'export_service_area'])->name('export-service-area');
        Route::get('export-selected-area',[ProviderProfileController::class,'export_selected_area'])->name('export-selected-area');
        Route::post('store-import-service-area',[ProviderProfileController::class,'store_import_service_area'])->name('store-import-service-area');
        Route::post('store-single-area',[ProviderProfileController::class,'store_single_area'])->name('store-single-area');
        Route::delete('remove-single-area/{id}',[ProviderProfileController::class,'remove_single_area'])->name('remove-single-area');

        Route::resource('my-withdraw', WithdrawController::class);
        Route::get('get-withdraw-account-info/{id}', [WithdrawController::class, 'getWithDrawAccountInfo'])->name('get-withdraw-account-info');

        Route::resource('service', ServiceController::class);
        Route::get('review-list', [ServiceController::class, 'reviewList'])->name('review-list');
        Route::get('show-review/{id}', [ServiceController::class, 'showReview'])->name('show-review');
        Route::get('awaiting-for-approval-service', [ServiceController::class, 'awaitingForApproval'])->name('awaiting-for-approval-service');
        Route::get('active-service', [ServiceController::class, 'activeService'])->name('active-service');
        Route::get('banned-service', [ServiceController::class, 'bannedService'])->name('banned-service');

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
        Route::put('payment-approved/{id}', [ProviderOrderController::class, 'paymentApproved'])->name('payment-approved');
        Route::get('booking-show/{id}', [ProviderOrderController::class, 'show'])->name('booking-show');

        Route::get('complete-request', [ProviderOrderController::class, 'completeRequest'])->name('complete-request');
        Route::post('send-order-complete-request', [ProviderOrderController::class, 'sendCompleteRequest'])->name('send-order-complete-request');

        Route::resource('coupon', CouponController::class);
        Route::get('coupon-history', [CouponController::class, 'coupon_history'])->name('coupon-history');

        Route::get('live-chat', [MessageController::class, 'index'])->name('live-chat');
        Route::get('load-chat-box/{id}', [MessageController::class, 'load_chat_box'])->name('load-chat-box');
        Route::post('send-message-to-buyer', [MessageController::class, 'send_message_to_buyer'])->name('send-message-to-buyer');

        Route::get('find-new-buyer/{id}', [MessageController::class, 'find_new_buyer'])->name('find-new-buyer');

    });


});

// start admin routes
Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){

    // start auth route
    Route::get('login', [AdminLoginController::class,'adminLoginPage'])->name('login');
    Route::post('login', [AdminLoginController::class,'storeLogin'])->name('store-login');
    Route::post('logout', [AdminLoginController::class,'adminLogout'])->name('logout');
    Route::get('forget-password', [AdminForgotPasswordController::class,'forgetPassword'])->name('forget-password');
    Route::post('send-forget-password', [AdminForgotPasswordController::class,'sendForgetEmail'])->name('send.forget.password');
    Route::get('reset-password/{token}', [AdminForgotPasswordController::class,'resetPassword'])->name('reset.password');
    Route::post('password-store/{token}', [AdminForgotPasswordController::class,'storeResetData'])->name('store.reset.password');
    // end auth route

    Route::resource('admin', AdminController::class);
    Route::put('admin-status/{id}', [AdminController::class,'changeStatus'])->name('admin-status');
    Route::get('profile', [AdminProfileController::class,'index'])->name('profile');
    Route::put('profile-update', [AdminProfileController::class,'update'])->name('profile.update');

    Route::get('subscriber',[SubscriberController::class,'index'])->name('subscriber');
    Route::delete('delete-subscriber/{id}',[SubscriberController::class,'destroy'])->name('delete-subscriber');
    Route::post('specification-subscriber-email/{id}',[SubscriberController::class,'specificationSubscriberEmail'])->name('specification-subscriber-email');
    Route::post('each-subscriber-email',[SubscriberController::class,'eachSubscriberEmail'])->name('each-subscriber-email');

    Route::get('contact-message',[ContactMessageController::class,'index'])->name('contact-message');
    Route::delete('delete-contact-message/{id}',[ContactMessageController::class,'destroy'])->name('delete-contact-message');
    Route::put('enable-save-contact-message',[ContactMessageController::class,'handleSaveContactMessage'])->name('enable-save-contact-message');

    Route::get('general-setting',[SettingController::class,'index'])->name('general-setting');
    Route::put('update-general-setting',[SettingController::class,'updateGeneralSetting'])->name('update-general-setting');

    Route::put('update-theme-color',[SettingController::class,'updateThemeColor'])->name('update-theme-color');

    Route::put('update-logo-favicon',[SettingController::class,'updateLogoFavicon'])->name('update-logo-favicon');
    Route::put('update-cookie-consent',[SettingController::class,'updateCookieConset'])->name('update-cookie-consent');
    Route::put('update-google-recaptcha',[SettingController::class,'updateGoogleRecaptcha'])->name('update-google-recaptcha');
    Route::put('update-facebook-comment',[SettingController::class,'updateFacebookComment'])->name('update-facebook-comment');
    Route::put('update-tawk-chat',[SettingController::class,'updateTawkChat'])->name('update-tawk-chat');
    Route::put('update-google-analytic',[SettingController::class,'updateGoogleAnalytic'])->name('update-google-analytic');
    Route::put('update-custom-pagination',[SettingController::class,'updateCustomPagination'])->name('update-custom-pagination');
    Route::put('update-social-login',[SettingController::class,'updateSocialLogin'])->name('update-social-login');
    Route::put('update-facebook-pixel',[SettingController::class,'updateFacebookPixel'])->name('update-facebook-pixel');
    Route::put('update-pusher',[SettingController::class,'updatePusher'])->name('update-pusher');
    Route::put('update-database',[SettingController::class,'update_database'])->name('update-database');

    Route::get('admin-language', [LanguageController::class, 'adminLnagugae'])->name('admin-language');
    Route::post('update-admin-language', [LanguageController::class, 'updateAdminLanguage'])->name('update-admin-language');

    Route::get('admin-validation-language', [LanguageController::class, 'adminValidationLnagugae'])->name('admin-validation-language');
    Route::post('update-admin-validation-language', [LanguageController::class, 'updateAdminValidationLnagugae'])->name('update-admin-validation-language');

    Route::get('website-language', [LanguageController::class, 'websiteLanguage'])->name('website-language');
    Route::post('update-language', [LanguageController::class, 'updateLanguage'])->name('update-language');

    Route::get('website-validation-language', [LanguageController::class, 'websiteValidationLanguage'])->name('website-validation-language');
    Route::post('update-validation-language', [LanguageController::class, 'updateValidationLanguage'])->name('update-validation-language');

    Route::get('email-configuration',[EmailConfigurationController::class,'index'])->name('email-configuration');
    Route::put('update-email-configuraion',[EmailConfigurationController::class,'update'])->name('update-email-configuraion');

    Route::get('email-template',[EmailTemplateController::class,'index'])->name('email-template');
    Route::get('edit-email-template/{id}',[EmailTemplateController::class,'edit'])->name('edit-email-template');
    Route::put('update-email-template/{id}',[EmailTemplateController::class,'update'])->name('update-email-template');

    Route::resource('blog-category', BlogCategoryController::class);
    Route::put('blog-category-status/{id}', [BlogCategoryController::class,'changeStatus'])->name('blog.category.status');

    Route::resource('blog', BlogController::class);
    Route::put('blog-status/{id}', [BlogController::class,'changeStatus'])->name('blog.status');

    Route::resource('popular-blog', PopularBlogController::class);
    Route::put('popular-blog-status/{id}', [PopularBlogController::class,'changeStatus'])->name('popular-blog.status');

    Route::resource('blog-comment', BlogCommentController::class);
    Route::put('blog-comment-status/{id}', [BlogCommentController::class,'changeStatus'])->name('blog-comment.status');

    Route::resource('about-us', AboutUsController::class);
    Route::post('store-how-it-work', [AboutUsController::class, 'addNewHotItWork'])->name('store-how-it-work');
    Route::put('update-how-it-work/{id}', [AboutUsController::class, 'updateHotItWork'])->name('update-how-it-work');
    Route::delete('delete-how-it-work/{id}', [AboutUsController::class, 'deleteHotItWork'])->name('delete-how-it-work');

    Route::put('update-header', [AboutUsController::class, 'updateHeader'])->name('update-header');
    Route::put('update-about-us', [AboutUsController::class, 'updateAboutUs'])->name('update-about-us');
    Route::put('update-why-choose-use', [AboutUsController::class, 'updateWhyChooseUs'])->name('update-why-choose-use');

    Route::resource('contact-us', ContactPageController::class);

    Route::resource('custom-page', CustomPageController::class);
    Route::put('custom-page-status/{id}', [CustomPageController::class,'changeStatus'])->name('custom-page.status');

    Route::resource('terms-and-condition', TermsAndConditionController::class);
    Route::resource('privacy-policy', PrivacyPolicyController::class);

    Route::resource('faq', FaqController::class);
    Route::put('faq-status/{id}', [FaqController::class,'changeStatus'])->name('faq-status');

    Route::resource('error-page', ErrorPageController::class);

    Route::resource('footer', FooterController::class);
    Route::resource('social-link', FooterSocialLinkController::class);
    Route::resource('footer-link', FooterLinkController::class);
    Route::get('second-col-footer-link', [FooterLinkController::class, 'secondColFooterLink'])->name('second-col-footer-link');
    Route::get('third-col-footer-link', [FooterLinkController::class, 'thirdColFooterLink'])->name('third-col-footer-link');
    Route::put('update-col-title/{id}', [FooterLinkController::class, 'updateColTitle'])->name('update-col-title');

    Route::get('topbar-contact', [ContentController::class, 'headerPhoneNumber'])->name('topbar-contact');
    Route::put('update-topbar-contact', [ContentController::class, 'updateHeaderPhoneNumber'])->name('update-topbar-contact');


    Route::resource('slider', SliderController::class);
    Route::put('slider-status/{id}',[SliderController::class,'changeStatus'])->name('slider-status');

    Route::resource('mobile-slider', MobileSliderController::class);



    Route::resource('counter', CounterController::class);
    Route::put('counter-status/{id}', [CounterController::class,'changeStatus'])->name('counter.status');
    Route::put('update-counter-bg', [CounterController::class,'updateCounterBg'])->name('update-counter-bg');

    Route::resource('testimonial', TestimonialController::class);
    Route::put('testimonial-status/{id}', [TestimonialController::class,'changeStatus'])->name('testimonial.status');

    Route::get('join-as-a-provider', [ContentController::class, 'joinAsAProvider'])->name('join-as-a-provider');
    Route::put('update-join-as-a-provider', [ContentController::class, 'updatejoinAsAProvider'])->name('update-join-as-a-provider');

    Route::get('mobile-app', [ContentController::class, 'mobileApp'])->name('mobile-app');
    Route::put('update-mobile-app', [ContentController::class, 'updateMobileApp'])->name('update-mobile-app');

    Route::get('subscriber-section', [ContentController::class, 'subscriberSection'])->name('subscriber-section');
    Route::put('update-subscriber-section', [ContentController::class, 'updateSubscriberSection'])->name('update-subscriber-section');

    Route::get('home2-contact', [ContentController::class, 'home2Contact'])->name('home2-contact');
    Route::put('update-home2-contact', [ContentController::class, 'updateHome2Contact'])->name('update-home2-contact');

    Route::get('how-it-work', [ContentController::class, 'howItWork'])->name('how-it-work');
    Route::put('update-how-it-work', [ContentController::class, 'updateHowItWork'])->name('home-update-how-it-work');

    Route::get('section-content', [ContentController::class, 'sectionContent'])->name('section-content');
    Route::put('update-section-content/{id}', [ContentController::class, 'updateSectionContent'])->name('update-section-content');

    Route::get('section-control', [ContentController::class, 'sectionControl'])->name('section-control');
    Route::put('update-section-control', [ContentController::class, 'updateSectionControl'])->name('update-section-control');

    Route::get('customer-list',[CustomerController::class,'index'])->name('customer-list');
    Route::get('customer-show/{id}',[CustomerController::class,'show'])->name('customer-show');
    Route::put('customer-status/{id}',[CustomerController::class,'changeStatus'])->name('customer-status');
    Route::delete('customer-delete/{id}',[CustomerController::class,'destroy'])->name('customer-delete');
    Route::get('pending-customer-list',[CustomerController::class,'pendingCustomerList'])->name('pending-customer-list');
    Route::get('send-email-to-all-customer',[CustomerController::class,'sendEmailToAllUser'])->name('send-email-to-all-customer');
    Route::post('send-mail-to-all-user',[CustomerController::class,'sendMailToAllUser'])->name('send-mail-to-all-user');
    Route::post('send-mail-to-single-user/{id}',[CustomerController::class,'sendMailToSingleUser'])->name('send-mail-to-single-user');

    Route::resource('withdraw-method', WithdrawMethodController::class);
    Route::put('withdraw-method-status/{id}',[WithdrawMethodController::class,'changeStatus'])->name('withdraw-method-status');

    Route::get('provider-withdraw', [ProviderWithdrawController::class, 'index'])->name('provider-withdraw');
    Route::get('pending-provider-withdraw', [ProviderWithdrawController::class, 'pendingProviderWithdraw'])->name('pending-provider-withdraw');

    Route::get('show-provider-withdraw/{id}', [ProviderWithdrawController::class, 'show'])->name('show-provider-withdraw');
    Route::delete('delete-provider-withdraw/{id}', [ProviderWithdrawController::class, 'destroy'])->name('delete-provider-withdraw');
    Route::put('approved-provider-withdraw/{id}', [ProviderWithdrawController::class, 'approvedWithdraw'])->name('approved-provider-withdraw');

    Route::get('payment-method',[PaymentMethodController::class,'index'])->name('payment-method');
    Route::put('update-paypal',[PaymentMethodController::class,'updatePaypal'])->name('update-paypal');
    Route::put('update-stripe',[PaymentMethodController::class,'updateStripe'])->name('update-stripe');
    Route::put('update-razorpay',[PaymentMethodController::class,'updateRazorpay'])->name('update-razorpay');
    Route::put('update-bank',[PaymentMethodController::class,'updateBank'])->name('update-bank');
    Route::put('update-mollie',[PaymentMethodController::class,'updateMollie'])->name('update-mollie');
    Route::put('update-paystack',[PaymentMethodController::class,'updatePayStack'])->name('update-paystack');
    Route::put('update-flutterwave',[PaymentMethodController::class,'updateflutterwave'])->name('update-flutterwave');
    Route::put('update-instamojo',[PaymentMethodController::class,'updateInstamojo'])->name('update-instamojo');
    Route::put('update-paymongo',[PaymentMethodController::class,'updatePaymongo'])->name('update-paymongo');
    Route::put('update-cash-on-delivery',[PaymentMethodController::class,'updateCashOnDelivery'])->name('update-cash-on-delivery');

    Route::resource('partner', PartnerController::class);
    Route::put('partner-status/{id}', [PartnerController::class,'changeStatus'])->name('partner-status');

    Route::resource('category', CategoryController::class);
    Route::put('category-status/{id}', [CategoryController::class,'changeStatus'])->name('category.status');

    Route::resource('country', CountryController::class);
    Route::put('country-status/{id}',[CountryController::class,'changeStatus'])->name('country-status');

    Route::resource('state', CountryStateController::class);
    Route::put('state-status/{id}',[CountryStateController::class,'changeStatus'])->name('state-status');

    Route::resource('city', CityController::class);
    Route::put('city-status/{id}',[CityController::class,'changeStatus'])->name('city-status');

    Route::get('state-by-country/{id}',[CityController::class,'stateByCountry'])->name('state-by-country');
    Route::get('city-by-state/{id}',[CityController::class,'cityByState'])->name('city-by-state');

    Route::get('provider',[ProviderController::class, 'index'])->name('provider');
    Route::get('pending-provider',[ProviderController::class, 'pendingProvider'])->name('pending-provider');
    Route::get('provider-show/{id}',[ProviderController::class,'show'])->name('provider-show');
    Route::put('provider-update/{id}',[ProviderController::class,'updateProvider'])->name('provider-update');
    Route::delete('provider-delete/{id}',[ProviderController::class,'destroy'])->name('provider-delete');
    Route::put('provider-status/{id}',[ProviderController::class,'changeStatus'])->name('provider-status');


    Route::get('send-email-to-all-provider',[ProviderController::class,'sendEmailToAllProvider'])->name('send-email-to-all-provider');
    Route::post('send-mail-to-all-provider',[ProviderController::class,'sendMailToAllProvider'])->name('send-mail-to-all-provider');
    Route::get('send-email-to-provider/{id}',[ProviderController::class,'sendEmailToProvider'])->name('send-email-to-provider');
    Route::post('send-mail-to-single-provider/{id}',[ProviderController::class,'sendMailtoSingleProvider'])->name('send-mail-to-single-provider');

    Route::get('default-avatar', [ContentController::class, 'defaultAvatar'])->name('default-avatar');
    Route::put('update-default-avatar', [ContentController::class, 'updateDefaultAvatar'])->name('update-default-avatar');

    Route::get('login-page', [ContentController::class, 'login_page'])->name('login-page');
    Route::put('update-login-page', [ContentController::class, 'update_login_page'])->name('update-login-page');



    Route::get('maintainance-mode',[ContentController::class,'maintainanceMode'])->name('maintainance-mode');
    Route::put('maintainance-mode-update',[ContentController::class,'maintainanceModeUpdate'])->name('maintainance-mode-update');

    Route::get('seo-setup',[ContentController::Class, 'seoSetup'])->name('seo-setup');
    Route::put('update-seo-setup/{id}',[ContentController::Class, 'updateSeoSetup'])->name('update-seo-setup');

    Route::get('all-booking', [OrderController::class, 'index'])->name('all-booking');
    Route::get('active-booking', [OrderController::class, 'activeBooking'])->name('active-booking');
    Route::get('awaiting-booking', [OrderController::class, 'awaitingBooking'])->name('awaiting-booking');
    Route::get('completed-booking', [OrderController::class, 'completeBooking'])->name('completed-booking');
    Route::get('declined-booking', [OrderController::class, 'declineBooking'])->name('declined-booking');
    Route::put('booking-declined/{id}', [OrderController::class, 'bookingDecilendRequest'])->name('booking-declined');
    Route::put('booking-approved/{id}', [OrderController::class, 'bookingApprovedRequest'])->name('booking-approved');
    Route::put('payment-approved/{id}', [OrderController::class, 'paymentApproved'])->name('payment-approved');

    Route::put('booking-mark-as-complete/{id}', [OrderController::class, 'bookingCompleteRequest'])->name('booking-mark-as-complete');
    Route::get('complete-request', [OrderController::class, 'completeRequest'])->name('complete-request');
    Route::put('refund-request-declined/{id}', [OrderController::class, 'RefundRequestDecilend'])->name('refund-request-declined');
    Route::put('refund-request-approved/{id}', [OrderController::class, 'RefundRequestApproved'])->name('refund-request-approved');
    Route::get('refund-request', [OrderController::class, 'refundRequest'])->name('refund-request');
    Route::get('booking-show/{id}', [OrderController::class, 'show'])->name('booking-show');
    Route::delete('delete-order/{id}', [OrderController::class, 'destroy'])->name('delete-order');

    Route::get('reports', [OrderController::class, 'providerClientReport'])->name('reports');
    Route::delete('delete-client-provider-report/{id}', [OrderController::class, 'deleteProviderClientReport'])->name('delete-client-provider-report');

    Route::get('ticket', [TicketController::class, 'index'])->name('ticket');
    Route::get('ticket-show/{id}', [TicketController::class, 'show'])->name('ticket-show');
    Route::delete('ticket-delete/{id}', [TicketController::class, 'destroy'])->name('ticket-delete');
    Route::put('ticket-closed/{id}', [TicketController::class, 'closed'])->name('ticket-closed');
    Route::post('store-ticket-message', [TicketController::class, 'storeMessage'])->name('store-ticket-message');

    Route::resource('service', AdminServiceController::class);
    Route::get('awaiting-for-approval-service', [AdminServiceController::class, 'awaitingForApproval'])->name('awaiting-for-approval-service');
    Route::get('active-service', [AdminServiceController::class, 'activeService'])->name('active-service');
    Route::get('banned-service', [AdminServiceController::class, 'bannedService'])->name('banned-service');

    Route::get('review-list', [AdminServiceController::class, 'reviewList'])->name('review-list');
    Route::get('show-review/{id}', [AdminServiceController::class, 'showReview'])->name('show-review');
    Route::delete('delete-service-review/{id}', [AdminServiceController::class, 'deleteReview'])->name('delete-service-review');
    Route::put('update-review/{id}', [AdminServiceController::class, 'updateReview'])->name('update-review');

    Route::resource('banner-image', BreadcrumbController::class);

    Route::get('/', [DashboardController::class,'dashobard']);
    Route::get('dashboard', [DashboardController::class,'dashobard'])->name('dashboard');

    Route::get('clear-database',[SettingController::class,'showClearDatabasePage'])->name('clear-database');
    Route::delete('delete-clear-database',[SettingController::class,'clearDatabase'])->name('delete-clear-database');



    Route::get('menu-visibility', [MenuVisibilityController::class, 'index'])->name('menu-visibility');
    Route::put('update-menu-visibility', [MenuVisibilityController::class, 'update'])->name('update-menu-visibility');


    Route::resource('coupon', AdminCouponController::class);
    Route::get('coupon-history', [AdminCouponController::class, 'coupon_history'])->name('coupon-history');






});

});
// end admin routes
