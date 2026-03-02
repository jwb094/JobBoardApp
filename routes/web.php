<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\JobListingsEmployer;
use App\Http\Controllers\JobListingsUser;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\SavedJobListingController;
use App\Http\Middleware\AuthUser;
use App\Http\Middleware\IsUser;




Route::get('/', [JobListingController::class, 'index'])->name('home');
Route::get('/job/{id}/{slug}', [JobListingController::class, 'show']);
Route::get('/job/{id}/{slug}/apply', [JobListingController::class, 'apply'])->middleware(IsUser::class);


Route::get('/user/signin', [JobListingsUser::class, 'signin'])->name('user-login-page');
Route::post('/user/login', [JobListingsUser::class, 'login']);
Route::get('/user/register', [JobListingsUser::class, 'register'])->name('user-register-page');
Route::post('/user/create', [JobListingsUser::class, 'store']);
Route::get('/user/logout', [JobListingsUser::class, 'logout'])->name('logout')->middleware(IsUser::class);
Route::get('/user/dashboard', [JobListingsUser::class, 'index'])->name('user.dashboard')->middleware(IsUser::class);
//Route::get('/user/dashboard', [JobListingsUser::class, 'index'])->name('user.dashboard')->middleware(IsUser::class);
Route::get('/user/{id}/applications', [JobListingsUser::class, 'applications'])->name('user.applications')->middleware(IsUser::class);
Route::get('/user/{id}/savedjobs', [JobListingsUser::class, 'savedjobs'])->name('user.savedjobs')->middleware(IsUser::class);
Route::get('/user/{id}/documents', [JobListingsUser::class, 'documents'])->name('user.documents')->middleware(IsUser::class);
Route::get('/user/{id}/savedjobs', [JobListingsUser::class, 'savedjobs'])->name('user.savedjobs')->middleware(IsUser::class);
Route::post('/user/{id}/store_documents', [JobListingsUser::class, 'store_documents'])->name('user.store_documents')->middleware(IsUser::class);



Route::get('/user/edit/{user_id}', [JobListingsUser::class, 'edit'])->name('user-update-page')->middleware(IsUser::class);
Route::post('/user/update/{user_id}', [JobListingsUser::class, 'update'])->name('user-update')->middleware(IsUser::class);
Route::post('/job/update_wishlist', [SavedJobListingController::class, 'update'])->middleware(IsUser::class);
Route::post('/job/sumbit_application/{job_id}/{user_id}', [ApplicationController::class, 'store'])->middleware(IsUser::class);




Route::get('/employer/signin', [JobListingsEmployer::class, 'signin'])->name('employer.login.page');
Route::post('/employer/login', [JobListingsEmployer::class, 'login'])->name('employer.login');
Route::get('/employer/register', [JobListingsEmployer::class, 'register'])->name('employer.register.page');
Route::post('/employer/create', [JobListingsEmployer::class, 'store']);
Route::get('/employer/logout', [JobListingsEmployer::class, 'logout'])->name('enployer.logout')->middleware(AuthUser::class);

Route::get('/employer/dashboard', [JobListingsEmployer::class, 'index'])->name('employer.dashboard')->middleware(AuthUser::class);
Route::get('/employer/new_job', [JobListingsEmployer::class, 'newjob'])->name('employer.newjobdesc.page')->middleware(AuthUser::class);
Route::post('/employer/save_job', [JobListingsEmployer::class, 'create'])->name('employer.newjobdesc')->middleware(AuthUser::class);
Route::get('/employer/edit_job/{jobDescId}', [JobListingsEmployer::class, 'edit_Job'])->name('employer.editjobdesc.page')->middleware(AuthUser::class);
Route::put('/employer/update_job/{jobDescId}', [JobListingsEmployer::class, 'update'])->name('employer.updatejobdesc')->middleware(AuthUser::class);
Route::get('employer/jobs_applicants', [JobListingsEmployer::class, 'applicantsAndJob'])->name('employer.applicantsAndJob.page')->middleware(AuthUser::class);
Route::get('/employer/edit/{id}', [JobListingsEmployer::class, 'edit_profile'])->name('employer-profile-page')->middleware(AuthUser::class);
Route::put('/employer/update_profile/{id}', [JobListingsEmployer::class, 'update_profile'])->name('employer.updateprofile')->middleware(AuthUser::class);


Route::delete('employer/delete_user/{userId}', [JobListingsEmployer::class, 'destroy'])->middleware(AuthUser::class);
Route::delete('employer/delete_job/{jobDescId}', [JobListingsEmployer::class, 'destroy_jobDesc'])->middleware(AuthUser::class);
