<?php

use Illuminate\Http\Request;
use Modules\JobPost\Http\Controllers\API\FontendHomeController;
use Modules\JobPost\Http\Controllers\API\UserHomeController;

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

Route::middleware('auth:api')->get('/jobpost', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['demo','XSS']], function () {
    Route::group(['middleware' => ['maintainance']], function () {

        Route::controller(FontendHomeController::class)->group(function () {
            Route::get('/job-list', 'jobList')->name('job-list');
            Route::get('/serch-job', 'SerchJob')->name('serch-job');
            Route::get('/job-detils/{slug}', 'JobDetils')->name('job-detils');
            Route::post('/apply-job', 'ApplyJob')->name('apply-job');
        });

        Route::resource('jobpost', UserHomeController::class);

        Route::controller(UserHomeController::class)->group(function () {
            Route::get('/job-post-applicants/{id}', 'job_post_applicants')->name('job-post-applicants');
            Route::put('/job-application-approval/{id}', 'job_application_approval')->name('job-application-approval');
        });
    });
});
