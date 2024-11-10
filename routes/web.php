<?php

use App\Http\Controllers\Admin\AssessmentController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VerifyController;
use App\Http\Controllers\Client\ApplicantController;
use App\Http\Controllers\Client\ApplicationController;
use App\Http\Controllers\Client\EmploymentController;
use App\Http\Controllers\Client\IdentificationController;
use App\Http\Controllers\Client\JobController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\SkillController as ClientSkillController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['inactive-user']);
Route::get('otp-password', [SiteController::class, 'otp']);
Route::post('otp-password', [SiteController::class, 'store_otp']);

Route::get('jobs', [SiteController::class, 'jobs']);

Route::prefix('admin')->middleware(['auth:web'])->group( function() {
    Route::resource('user-verify', VerifyController::class);
    Route::resource('users', UserController::class);
    Route::resource('skills', SkillController::class);
    Route::resource('assessments', AssessmentController::class);
});

Route::prefix('client')->middleware(['auth:web','inactive-user'])->group( function() {
    Route::resource('jobs', JobController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('identifications', IdentificationController::class);
    Route::resource('employments', EmploymentController::class);
    Route::resource('skills', ClientSkillController::class);
    Route::resource('applications', ApplicationController::class);
    Route::resource('applicants', ApplicantController::class);
});