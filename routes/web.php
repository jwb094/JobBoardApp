<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\JobListingsEmployer;
use App\Http\Controllers\JobListingsAdmin;
use App\Http\Controllers\JobListingsUser;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\SavedJobListingController;
use App\Http\Middleware\AuthUser;


// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [JobListingController::class, 'index']);
//->middleware(['auth', 'employer']);
//  ->middleware(AuthUser::class, 'handle');
Route::resource('job-listings', JobListingController::class);

Route::resource('/employer', JobListingsEmployer::class);
Route::resource('/admin', JobListingsAdmin::class);
Route::resource('/application', ApplicationController::class);
Route::resource('/user', JobListingsUser::class);
Route::resource('/saved-job', SavedJobListingController::class);
