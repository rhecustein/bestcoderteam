<?php


use Modules\JobPost\Http\Controllers\JobPostController;
use Modules\JobPost\Http\Controllers\FontendHomeController;
use Modules\JobPost\Http\Controllers\UserHomeController;


Route::group(['middleware' => ['demo','XSS']], function () {

    Route::group(['middleware' => ['maintainance']], function () {

        Route::controller(FontendHomeController::class)->group(function () {
            Route::get('/job-list', 'jobList')->name('job-list');
            Route::get('/serch-job', 'SerchJob')->name('serch-job');
            Route::get('/job-detils/{slug}', 'JobDetils')->name('job-detils');
            Route::post('/apply-job', 'ApplyJob')->name('apply-job');
        });

        Route::group(['as'=> 'admin.', 'prefix' => 'admin/jobpost', 'middleware' => ['auth:admin']],function (){

            Route::resource('jobpost', JobPostController::class);

            Route::put('jobpost-approval/{id}', [JobPostController::class, 'jobpost_approval'])->name('jobpost-approval');

            Route::get('/job-post-applicants/{id}', [JobPostController::class,  'job_post_applicants'])->name('job-post-applicants');
            Route::put('/job-application-approval/{id}', [JobPostController::class,  'job_application_approval'])->name('job-application-approval');
            Route::get('/job-application-delete/{id}', [JobPostController::class,  'job_application_delete'])->name('job-application-delete');

            // Route::get('awaiting-listings', [JobPostController::class, 'awaiting_listings'])->name('awaiting-listings');
            // Route::get('featured-listings', [JobPostController::class, 'featured_listings'])->name('featured-listings');

            // Route::get('/job-posts', [JobPostController::class, 'job_posts'])->name('job-posts');
            // Route::get('/job-post-applicants/{id}', [JobPostController::class,  'job_post_applicants'])->name('job-post-applicants');
            // Route::put('/job-application-approval/{id}', [JobPostController::class,  'job_application_approval'])->name('job-application-approval');
            // Route::delete('/job-application-delete/{id}', [JobPostController::class,  'job_application_delete'])->name('job-application-delete');

        });

        Route::resource('jobpost', UserHomeController::class);

        Route::controller(UserHomeController::class)->group(function () {
            Route::get('/user/job-list', 'jobList')->name('user.job-list');
            Route::get('/job-post-applicants/{id}', 'job_post_applicants')->name('job-post-applicants');
            Route::put('/job-application-approval/{id}', 'job_application_approval')->name('job-application-approval');
            Route::get('/job-application-delete/{id}', 'job_application_delete')->name('job-application-delete');
        });

        // Route::group(['as' => 'user.', 'prefix' => 'user', 'middleware' => ['CheckClient']], function () {
        //     // Define resource routes separately


        //     // Define other routes inside a Route::controller group
        //     Route::controller(UserHomeController::class)->group(function () {
        //         Route::get('/job-list', 'jobList')->name('job-list');
        //         Route::get('/job-post-applicants/{id}', 'job_post_applicants')->name('job-post-applicants');
        //         Route::put('/job-application-approval/{id}', 'job_application_approval')->name('job-application-approval');
        //         Route::get('/job-application-delete/{id}', 'job_application_delete')->name('job-application-delete');
        //     });
        // });
    });

});
