<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard',function(){
	return view('layouts.master');
});

Route::get('/home', 'HomeController@index')->name('home');




Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('products','ProductController');

    
    Route::prefix('/manage/course')->group(function ()
    {
        Route::get('/', 'CourseController@getManageCourse')->name('manageCourse');
        Route::post('/insert', 'CourseController@postInsertAcademic')->name('postInsertAcademic');
        Route::post('/insert-program', 'CourseController@postInsertProgram')->name('postInsertProgram');
        Route::post('/insert-level', 'CourseController@postInsertLevel')->name('postInsertLevel');
        Route::get('/showLevel', 'CourseController@showLevel')->name('showLevel');
        Route::post('/shift', 'CourseController@createShift')->name('createShift');
        Route::post('/time', 'CourseController@createTime')->name('createTime');
        Route::post('/batch', 'CourseController@createBatch')->name('createBatch');
        Route::post('/group', 'CourseController@createGroup')->name('createGroup');
        Route::post('/class', 'CourseController@createClass')->name('createClass');
        Route::get('/classinfo', 'CourseController@showClassInformation')->name('showClassInformation');
        Route::post('/class/delete', 'CourseController@deleteClass')->name('deleteClass');
        Route::get('/class/edit', 'CourseController@editClass')->name('editClass');
        Route::post('/class/update', 'CourseController@updateClassInfo')->name('updateClassInfo');
    });
    //==================Student Register===============
    Route::prefix('/student')->group(function ()
    {
        Route::get('/getregister', 'StudentController@getStudentRegister')->name('getStudentRegister');
        Route::post('/postregister', 'StudentController@postStudentRegister')->name('postStudentRegister');
        Route::get('/info', 'StudentController@studentInfo')->name('studentInfo');
        Route::get('/show/payment', 'FeeController@getPayment')->name('getPayment');
        Route::get('/payment', 'FeeController@showStudentPayment')->name('showStudentPayment');
        Route::get('/got/to/payment/{student_id}', 'FeeController@goPayment')->name('goPayment');
        Route::post('/payment/save', 'FeeController@savePayment')->name('savePayment');
    });


    Route::prefix('/fee')->group(function ()
    {
        Route::post('/create', 'FeeController@createFee')->name('createFee');
        Route::get('/student/pay', 'FeeController@pay')->name('pay');
        Route::post('/student/extraPay', 'FeeController@extraPay')->name('extraPay');
        Route::get('/student/print/invoice/{receiptId}', 'FeeController@printInvoice')->name('printInvoice');
        Route::get('/student/transaction/delete/{transactId}', 'FeeController@deleteTransaction')->name('deleteTransaction');
        Route::get('/student/show/level', 'FeeController@showLevelStudent')->name('showLevelStudent');
        Route::get('/report', 'FeeController@getFeeReport')->name('getFeeReport');
        Route::get('/show-fee-report', 'FeeController@showFeeReport')->name('showFeeReport');
    });

    
        // Route test
    Route::get('/create/student/level', 'FeeController@createStudentLevel')->name('createStudentLevel');


    Route::prefix('/report')->group(function ()
    {
        Route::get('/student-list', 'ReportController@getStudentList')->name('getStudentList');
        Route::get('/student-info', 'ReportController@showStudentInfo')->name('showStudentInfo');
        Route::get('/student-multi-class', 'ReportController@getStudentListMultiClass')->name('getStudentListMultiClass');
        Route::get('/student-info-multi -class', 'ReportController@showStudentInfoMultiClass')->name('showStudentInfoMultiClass');
        Route::get('/new/register', 'ReportController@getNewStudentRegister')->name('getNewStudentRegister');
    });
    
});
