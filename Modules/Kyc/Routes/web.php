<?php

use Modules\Kyc\Http\Controllers\KycInfoController;
use Modules\Kyc\Http\Controllers\KycTypeController;
use Modules\Kyc\Http\Controllers\KycController;

Route::middleware('demo')->group(function(){
    Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){

        Route::resource('kyc', KycTypeController::class);

        Route::controller(KycTypeController::class)->group(function () {
            Route::get('kyc-list', 'kycList')->name('kyc-list');
            Route::delete('delete-kyc-info/{id}', 'DestroyKyc')->name('delete-kyc-info');
            Route::put('update-kyc-status/{id}', 'UpdateKycStatus')->name('update-kyc-status');
        });

    });

    Route::group(['as'=> 'provider.', 'prefix' => 'provider'],function (){

        Route::controller(KycController::class)->group(function () {
            Route::get('kyc', 'kyc')->name('kyc');
            Route::post('kyc-submit', 'kycSubmit')->name('kyc-submit');
        });

    });
});
