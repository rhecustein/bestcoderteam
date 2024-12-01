<?php

use Illuminate\Http\Request;
use Modules\Kyc\Http\Controllers\API\KycController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/kyc', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['demo','XSS']], function () {
    Route::group(['middleware' => ['maintainance']], function () {

        Route::group(['as'=> 'provider.', 'prefix' => 'provider','middleware' => ['auth:api']],function (){
            Route::controller(KycController::class)->group(function () {
                Route::get('kyc', 'kyc')->name('kyc');
                Route::post('kyc-submit', 'kycSubmit')->name('kyc-submit');
            });
        });
    });
});
