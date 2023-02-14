<?php

use App\Http\Controllers\Parents\childrenController;
use App\Models\Attendance;
use App\Models\Student;
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ], function () 
    {
        //==============================dashboard====================================
        Route::get('/parent/dashboard', function () {
            $children = Student::where('parent_id' , auth()->user()->id)->get();
            return view('pages.Parents.dashboard' ,compact('children'));
    });


    Route::group(['namespace' => 'Parents'] , function()
    {
        Route::get('children' , 'childrenController@index')->name('children');
        Route::get('children.results/{id}' , 'childrenController@results')->name('children.results');
        Route::get('attendance' , 'childrenController@attendance')->name('attendance.children');
        Route::post('childrenAttendance' , 'childrenController@attendanceSearch')->name('childrenAttendance.search');
        Route::get('feesChildren' , 'childrenController@getFees')->name('fees.children');
        Route::get('feesChildren/{id}' , 'childrenController@getReceipt')->name('children.receipt');
        Route::get('parents.profile' , 'childrenController@getProfile')->name('parents.profile');
        Route::post('parents.profile/{id}' , 'childrenController@updateProfile')->name('parents.update');
    }); 

});