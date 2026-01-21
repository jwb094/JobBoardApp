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

//Route::resource('/user', JobListingsUser::class);

Route::get('/user/signin', [JobListingsUser::class, 'signin'])->name('user-login-page');
Route::post('/user/login', [JobListingsUser::class, 'login']);
Route::get('/user/register', [JobListingsUser::class, 'register']);
Route::post('/user/create', [JobListingsUser::class, 'store']);
Route::get('/user/logout', [JobListingsUser::class, 'logout'])->name('logout')->middleware(IsUser::class);
Route::get('/user/dashboard', [JobListingsUser::class, 'index'])->name('user.dashboard')->middleware(IsUser::class);
//Route::get('/user/dashboard', [JobListingsUser::class, 'index'])->name('user.dashboard')->middleware(IsUser::class);
Route::get('/user/{id}/applications', [JobListingsUser::class, 'applications'])->name('user.applications')->middleware(IsUser::class);
Route::get('/user/{id}/savedjobs', [JobListingsUser::class, 'savedjobs'])->name('user.savedjobs')->middleware(IsUser::class);
Route::get('/user/{id}/documents', [JobListingsUser::class, 'documents'])->name('user.documents')->middleware(IsUser::class);


Route::get('/user/edit/{user_id}', [JobListingsUser::class, 'edit'])->name('user-update-page');
Route::post('/user/update/{user_id}', [JobListingsUser::class, 'update'])->name('user-update');


Route::get('/employer/signin', [JobListingsEmployer::class, 'signin'])->name('employer-login-page');
Route::post('/employer/login', [JobListingsEmployer::class, 'loginEmployerUser'])->name('employer-login');;
Route::get('/employer/register', [JobListingsEmployer::class, 'register'])->name('employer-register-page');
Route::post('/employer/create', [JobListingsEmployer::class, 'store'])->name('new-employer');
Route::post('/employer/delete', [JobListingsEmployer::class, 'deleteEmployerUser'])->middleware(AuthUser::class);
Route::get('/employer/logout', [JobListingsEmployer::class, 'logout'])->name('logout')->middleware(AuthUser::class);
Route::get('/employer/dashboard', [JobListingsEmployer::class, 'dashboard'])->name('employer.dashboard')->middleware(AuthUser::class);
Route::get('/employer/job-applications', [JobListingsEmployer::class, 'viewJobApplications'])->middleware(AuthUser::class);

Route::get('/employer/edit/{user_id}', [JobListingsEmployer::class, 'editEmployer'])->name('user-update-page')->middleware(AuthUser::class);
Route::post('/employer/update/{user_id}', [JobListingsEmployer::class, 'updateEmployer'])->name('user-update')->middleware(AuthUser::class);;


Route::get('/employer/new-job', [JobListingsEmployer::class, 'newJob'])->middleware(AuthUser::class);
Route::post('/employer/save-job', [JobListingsEmployer::class, 'storeJob'])->middleware(AuthUser::class);
Route::post('/employer/delete-job/{job_id}', [JobListingsEmployer::class, 'deleteJob'])->middleware(AuthUser::class);
Route::get('/employer/edit/{job_id}', [JobListingsEmployer::class, 'editJob'])->middleware(AuthUser::class);
Route::post('/employer/update-job/{job_id}', [JobListingsEmployer::class, 'updateJob'])->middleware(AuthUser::class);


// Route::resource('/saved-job', SavedJobListingController::class);
// Route::resource('/user/new', JobListingsEmployer::class);
// Route::resource('/user/save', JobListingsEmployer::class);
// Route::resource('/user/delete', JobListingsEmployer::class);
// Route::resource('/user/edit', JobListingsEmployer::class);

// Route::get('/', [JobListingController::class, 'index']);
// Route::get('/', [JobListingController::class, 'index']);

//->middleware(['auth', 'employer']);
//  ->middleware(AuthUser::class, 'handle');
//Route::resource('job-listings', JobListingController::class);

/*
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