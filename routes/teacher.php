<?php

use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Teachers\profileController;
use App\Http\Controllers\Teachers\QuestionController;
use App\Models\Student;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================dashboard============================
    Route::get('/teacher/dashboard', function () {

        $ids = Teachers::findOrFail(auth()->user()->id)->sections()->pluck('sections_id');
        $data['count_sections'] = $ids->count();
        $data['count_students'] = Student::whereIn('section_id' , $ids)->count();
       
        return view('pages.Teachers.dashboard' , $data);

    });


    Route::group(['namespace' => 'Teachers'] , function(){

        Route::get('students' , 'StudentController@index')->name('students.index');
        Route::get('sections' , 'StudentController@sections')->name('sections');
        Route::post('attendance','StudentController@attendance')->name('attendance');
        Route::post('edit_attendance','StudentController@editAttendance')->name('attendance.edit');
        Route::get('attendance_report','StudentController@attendanceReport')->name('attendance.report');
        Route::post('attendance_search','StudentController@attendanceSearch')->name('attendance.search');
        Route::resource('quizzes', 'QuizzController');
        Route::resource('questions', 'QuestionController');
        Route::resource('online_zoom_classes', 'OnlineZoomClassesController');
        // Route::get('/indirect', 'OnlineZoomClassesController@indirectCreate')->name('indirect.teacher.create');
        // Route::post('/indirect', 'OnlineZoomClassesController@storeIndirect')->name('indirect.teacher.store');
        Route::get('profile_teacher' , 'profileController@index')->name('profile_teacher');
        Route::post('profile/{id}' , 'profileController@update')->name('profile.update');
        Route::get('student.quizze\{id}' , 'QuizzController@Student_quizzes')->name('student.quizze');
        Route::post('repeat.quizze' , 'QuizzController@repeat_quizze')->name('repeat.quizze');
    });


});