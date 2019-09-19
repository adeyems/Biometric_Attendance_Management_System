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


Route::get('/register/teacher', 'Auth\RegisterController@teacher')->name('teacherRegister');


//Register Page Routes
Route::post('/register/createParent', 'Auth\RegisterController@createParent')->name('createParent');

//Register Page Routes
Route::post('/register/createTeacher', 'Auth\RegisterController@createTeacher')->name('createTeacher');

//Logout
Route::get('/logout', 'Auth\LogoutController@index')->name('logout');

//report
Route::get('/request-report', 'ParentController@requestReport')->name('request-report');

//report
Route::post('/request-report', 'ParentController@submitRequestReport')->name('create-request-report');

//report
Route::post('/password-reset', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('reset.password');

Route::get('/student/attendance', 'StudentController@attendance')->name('student-daily-attendance');

Route::post('/student/attendance/daily', 'StudentController@attendanceDailyReport')->name('show-daily-attendance');

Route::post('/student/attendance', 'StudentController@createAttendanceReport')->name('create-attendance-report');

Route::get('/student/attendance/report', 'StudentController@attendanceReport')->name('student-attendance-report');

Route::get('/student/attendance/daily/{id}', 'StudentController@nextDailyReport')->name('next-daily-attendance');

Route::get('/student/attendance/report/{id}', 'StudentController@nextAttendanceReport')->name('next-attendance-report');

Route::get('/sms', 'SMSController@sendSMS');

Route::get('show-student-attendance', 'StudentController@AttendanceNext')->name('attendance-report-next');

Route::get('/password/email', 'Auth\ResetPasswordController@viewResetEmail')->name('reset-email');

Route::get('/password/reset-password', 'Auth\ResetPasswordController@viewResetPassword')->name('reset-password');

Route::post('/password/update', 'Auth\ResetPasswordController@UpdatePassword')->name('password.update');

Route::post('/password/reset', 'Auth\ResetPasswordController@sendResetEmail')->name('send-reset-email');

Route::get('/reset/{id}', 'Auth\ResetPasswordController@resetPassword');

Route::get('/api/students', 'API\FingerprintController@getAllStudents');

Route::post('/api/fingerprint/match/{id}', 'API\FingerprintController@isFingerPrintMatched');

Route::post('/api/fingerprint/register', 'API\FingerprintController@registerFingerprint');

Route::post('/api/send/message', 'API\MSGController@send');



