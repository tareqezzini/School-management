<?php

use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Exams\ExamsController;
use App\Http\Controllers\Fees\feesController;
use App\Http\Controllers\Fees\FeesInvoicesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Library\LibraryController;
use App\Http\Controllers\OnlineClasses\OnlineClassesController;
use App\Http\Controllers\Promotions\PromotionController;
use App\Http\Controllers\Questions\QuestionsController;
use App\Http\Controllers\Quizzess\QuizzesController;
use App\Http\Controllers\Receipt\ReceiptStudentsController;
use App\Http\Controllers\Sections\SectionsController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Students\GraduatedController;
use App\Http\Controllers\Students\PaymentController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Teachers\TeachersController;
use App\Models\Sections;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//==============================Auth Route ============================

Route::get('/',  'HomeController@index')->name('selection');

Route::group(['namespace' => 'Auth'], function()
{
    Route::get('/login/{type}' , 'LoginController@loginForm')->middleware('guest')->name('login.show');
    
    Route::post('/login' , 'LoginController@login')->name('login');

    Route::get('/logout/{type}' , 'LoginController@logout')->name('logout');
});

 //==============================Translate all pages ============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () {

     //==============================dashboard============================
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

   //==============================dashboard============================
    Route::group(['namespace' => 'Grades'], function () {
        Route::resource('Grades', 'GradeController');
    });

    //============================== Classrooms ============================
    Route::group(['namespace' => 'Classrooms'], function () {
        Route::resource('Classrooms', 'ClassroomController');
        Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');

        Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');

    });
    //============================== Sections ============================
    Route::group(['namespace' => 'Sections'], function () {
        Route::resource('Sections' , 'SectionsController');
        Route::get('classes/{id}' , 'SectionsController@getClasses');
        
    });
    //==============================Parents============================

    Route::view('add_parent' , 'livewire.parents')->name('add_parent');
    //============================== Teachers ============================
    Route::group(['namespace' => 'Teachers'], function () {
        Route::resource('Teachers' , 'TeachersController');
        
    });
    //============================== Students ============================
    Route::group(['namespace' => 'Students'], function () 
    {
        Route::resource('Students' , 'StudentController');

        Route::resource('Graduated' , 'GraduatedController');

        Route::resource('Payment_students' , 'PaymentController');
        
        Route::post('Upload_attachment' , 'StudentController@Upload_attachment')->name('Upload_attachment');
        Route::get('Download_attachment/{attachment_name}/{filename}' , 'StudentController@Download_attachment')->name('Download_attachment');
        Route::post('Delete_attachment' , 'StudentController@Delete_attachment')->name('Delete_attachment');
        
    });
    //============================== Promotions ============================
    Route::group(['namespace' => 'Promotions'] , function ()
    {   
        Route::resource('Promotion' , 'PromotionController');
    });
    //============================== Fees ============================
    Route::group(['namespace' => 'Fees'] , function ()
    {   
        Route::resource('Fees' , 'feesController');
        
        Route::resource('ProcessingFee', 'ProcessingFeeController');

        Route::resource('Fees_Invoices' , 'FeesInvoicesController');
    });
    //============================== Recept ============================
    Route::group(['namespace' => 'Receipt'] , function ()
    {   
        Route::resource('receipt_students' , 'ReceiptStudentsController');
    });
    //============================== Attendance ============================
    Route::group(['namespace' => 'Attendance'] , function ()
    {   
        Route::resource('Attendance' , 'AttendanceController');
    });
    //============================== Subjects ============================
    Route::group(['namespace' => 'Subjects'] , function ()
    {   
        Route::resource('subjects' , 'SubjectController');
    });

    //============================== Quizzes ============================
    Route::group(['namespace' => 'Quizzes'] , function ()
    {   
        Route::resource('Quizzes' , 'QuizzesController');
    });

    //==============================questions============================
    Route::group(['namespace' => 'Questions'], function () 
    {
        Route::resource('Questions_quizzes', 'QuestionsController');
    });
    //==============================Online Classes============================
    Route::group(['namespace' => 'OnlineClasses'], function () {
        Route::resource('online_classes', 'OnlineClassesController');
    });
    //============================== Library ============================
    Route::group(['namespace' => 'Library'], function () {
        Route::resource('library', 'LibraryController');
        Route::get('downloadAttachment/{filename}', 'LibraryController@downloadAttachment')->name('downloadAttachment');
    });
    //============================== Settings ============================
    Route::group(['namespace' => 'Settings'], function () {
        Route::resource('settings', 'SettingsController');
    });

});