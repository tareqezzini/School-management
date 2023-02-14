<?php

use App\Http\Controllers\Students\ExamController;
use App\Http\Controllers\Students\ExamsController;
use App\Http\Controllers\Students\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ], function () {

    //==============================dashboard============================
    Route::get('/student/dashboard', function () {
        return view('pages.Students.dashboard');
    });


    Route::group(['namespace' => 'Students'] , function()
    {
        Route::resource('student_exams', 'ExamController');
        Route::resource('student_profile', 'ProfileController');

    });

});