<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\JobListingsEmployer;
use App\Http\Controllers\JobListingsAdmin;
use App\Http\Controllers\JobListingsUser;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\SavedJobListingController;
use App\Http\Middleware\AuthUser;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;


// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [JobListingController::class, 'index'])->name('home');
Route::get('/job/{id}/{slug}', [JobListingController::class, 'show']);
Route::get('/job/{id}/{slug}/apply', [JobListingController::class, 'apply'])->middleware(IsUser::class);

//Route::resource('/user', JobListingsUser::class);

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




Route::post('/employer/signin', [JobListingsEmployer::class, 'signin'])->name('employer.login.page');
Route::get('/employer/login', [JobListingsEmployer::class, 'login'])->name('employer.register.page');
Route::get('/employer/register', [JobListingsEmployer::class, 'register'])->name('employer.register.page');
Route::get('/employer/logout', [JobListingsEmployer::class, 'logout'])->name('logout')->middleware(AuthUser::class);
Route::post('/user/create', [JobListingsEmployer::class, 'store']);

/*
//->middleware(IsUser::class);
Route::resource('/saved-job', SavedJobListingController::class);
Route::resource('/user/new', JobListingsEmployer::class);
Route::resource('/user/save', JobListingsEmployer::class);
Route::resource('/user/delete', JobListingsEmployer::class);
Route::resource('/user/edit', JobListingsEmployer::class);

// Route::get('/', [JobListingController::class, 'index']);
// Route::get('/', [JobListingController::class, 'index']);

//->middleware(['auth', 'employer']);
//  ->middleware(AuthUser::class, 'handle');
//Route::resource('job-listings', JobListingController::class);

Route::resource('/employer/login', JobListingsEmployer::class);
Route::resource('/employer/dashboard', JobListingsEmployer::class);
Route::resource('/employer/new', JobListingsEmployer::class);
Route::resource('/employer/save', JobListingsEmployer::class);
Route::resource('/employer/delete', JobListingsEmployer::class);
Route::resource('/employer/edit', JobListingsEmployer::class);
//->middleware(AuthUser::class, 'handle');
Route::resource('/admin/login', JobListingsAdmin::class);
Route::resource('/admin/dashboard', JobListingsEmployer::class);
Route::resource('/admin/new', JobListingsAdmin::class);
Route::resource('/admin/save', JobListingsAdmin::class);
Route::resource('/admin/delete', JobListingsAdmin::class);
Route::resource('/admin/edit', JobListingsAdmin::class);
//->middleware(AuthUser::class, 'checkAdmin');
Route::resource('/application', ApplicationController::class);
*/