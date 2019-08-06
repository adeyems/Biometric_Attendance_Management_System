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

Route::get('/', 'HomeController@index')->name('parent-home');


Route::get('/parent/home', 'ParentController@index')->name('parent-home');


Route::get('/teacher/home', 'TeacherController@index')->name('teacher-home');

//Login Page Routes
Route::get('/login/parent', 'Auth\LoginController@parent')->name('login.parent');
Route::get('/login/teacher', 'Auth\LoginController@teacher');

//Login Request Routes
Route::post('/login/parentLogin', 'Auth\LoginController@parentLogin')->name('parentLogin');;
Route::post('/login/teacherLogin', 'Auth\LoginController@teacherLogin')->name('teacherLogin');;

//Register Page Routes
Route::get('/register/parent', 'Auth\RegisterController@studentParent')->name('parentRegister');


//Register Page Routes
Route::post('/register/createParent', 'Auth\RegisterController@createParent')->name('createParent');

//Logout
Route::get('/logout', 'Auth\LogoutController@index')->name('logout');

//report
Route::get('/request-report', 'ParentController@requestReport')->name('request-report');

//report
Route::post('/request-report', 'ParentController@submitRequestReport')->name('create-request-report');

//report
Route::post('/password-reset', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('reset.password');

Route::get('/student/attendance', 'StudentController@attendance')->name('student-daily-attendance');


Route::get('/student/attendance/report', 'StudentController@attendanceReport')->name('student-attendance-report');

