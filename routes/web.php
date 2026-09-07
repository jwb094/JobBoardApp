<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\JobListingsEmployer;
use App\Http\Controllers\JobListingsUser;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\SavedJobListingController;
use App\Http\Middleware\AuthUser;
use App\Http\Middleware\IsUser;



Route::prefix('/')->group(function () {
    Route::get('/', [JobListingController::class, 'index'])->name('home');
    Route::get('job/{id}/{slug}', [JobListingController::class, 'show']);
    Route::get('job/{id}/{slug}/apply', [JobListingController::class, 'apply'])->middleware(IsUser::class);
});


// Route::get('/job/{id}/{slug}', [JobListingController::class, 'show']);
// Route::get('/job/{id}/{slug}/apply', [JobListingController::class, 'apply'])->middleware(IsUser::class);

Route::prefix('/user')->group(function () {
    Route::get('/signin', [JobListingsUser::class, 'signin'])->name('user.login');
    Route::post('/login', [JobListingsUser::class, 'login']);
    Route::get('/register', [JobListingsUser::class, 'register'])->name('user.register');
    Route::post('/create', [JobListingsUser::class, 'store']);
    Route::get('/logout', [JobListingsUser::class, 'logout'])->name('logout')->middleware(IsUser::class);
    Route::get('/dashboard', [JobListingsUser::class, 'index'])->name('user.dashboard')->middleware(IsUser::class);
    //Route::get('/user/dashboard', [JobListingsUser::class, 'index'])->name('user.dashboard')->middleware(IsUser::class);
    Route::get('/{id}/applications', [JobListingsUser::class, 'applications'])->name('user.applications')->middleware(IsUser::class);
    Route::get('/{id}/savedjobs', [JobListingsUser::class, 'savedjobs'])->name('user.savedjobs')->middleware(IsUser::class);
    Route::get('/{id}/documents', [JobListingsUser::class, 'documents'])->name('user.documents')->middleware(IsUser::class);
    Route::get('/{id}/savedjobs', [JobListingsUser::class, 'savedjobs'])->name('user.savedjobs')->middleware(IsUser::class);
    Route::post('/{id}/store_documents', [JobListingsUser::class, 'store_documents'])->name('user.store_documents')->middleware(IsUser::class);
    Route::get('/edit/{user_id}', [JobListingsUser::class, 'edit'])->name('user-update-page')->middleware(IsUser::class);
    Route::post('/update/{user_id}', [JobListingsUser::class, 'update'])->name('user-update')->middleware(IsUser::class);
});





Route::post('/job/update_wishlist', [SavedJobListingController::class, 'update'])->middleware(IsUser::class);
Route::post('/job/sumbit_application/{job_id}/{user_id}', [ApplicationController::class, 'store'])->name('job.apply')->middleware(IsUser::class);

Route::prefix('employer')->group(function () {

    Route::get('/signin', [JobListingsEmployer::class, 'signin'])->name('employer.login.page');
    Route::post('/login', [JobListingsEmployer::class, 'login'])->name('employer.login');
    Route::get('/register', [JobListingsEmployer::class, 'register'])->name('employer.register.page');
    Route::post('/create', [JobListingsEmployer::class, 'store'])->name('employer.store');
    Route::get('/logout', [JobListingsEmployer::class, 'logout'])->name('employer.logout')->middleware(AuthUser::class);

    Route::prefix('admin')->middleware(AuthUser::class)->group(function () {
        Route::get('/dashboard', [JobListingsEmployer::class, 'index'])->name('employer.dashboard');
        Route::get('/new_job', [JobListingsEmployer::class, 'newjob'])->name('employer.newjobdesc.page');
        Route::post('/save_job', [JobListingsEmployer::class, 'create'])->name('employer.newjobdesc');
        Route::get('/edit_job/{jobDescId}', [JobListingsEmployer::class, 'edit_Job'])->name('employer.editjobdesc.page');
        Route::put('/update_job/{jobDescId}', [JobListingsEmployer::class, 'update'])->name('employer.updatejobdesc');
        Route::get('/jobs_applicants', [JobListingsEmployer::class, 'applicantsAndJob'])->name('employer.applicantsAndJob.page');
        Route::get('/edit/{id}', [JobListingsEmployer::class, 'edit_profile'])->name('employer.profile.page');
        Route::put('/update_profile/{id}', [JobListingsEmployer::class, 'update_profile'])->name('employer.updateprofile');


        Route::delete('/delete_user/{userId}', [JobListingsEmployer::class, 'destroy']);
        Route::delete('/delete_job/{jobDescId}', [JobListingsEmployer::class, 'destroy_jobDesc']);
    });
});
