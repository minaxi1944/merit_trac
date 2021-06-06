<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/teacher','Teacher@index');
Route::get('/teacher/subject_creation','Teacher@subject_creation');
Route::post('/teacher/add_new_subject','Teacher@add_new_subject');
Route::get('/teacher/delete_subject/{subject_name}','Teacher@delete_subject');
Route::get('/teacher/update_subject/{subject_name}','Teacher@update_subject');
Route::post('/teacher/confirm_update_subject','Teacher@confirm_update_subject');

Route::get('/admin/manage_exam','Admin@manage_exam');
Route::post('/admin/add_new_exam','admin@add_new_exam');
Route::get('/admin/exam_status/{id}','Admin@exam_status');
Route::get('/admin/delete_exam/{id}','Admin@delete_exam');
Route::get('/admin/update_exam/{id}','Admin@update_exam');
Route::post('/admin/confirm_update_exam','Admin@confirm_update_exam');



/*Student*/
Route:: get('/student/signup','Student@student_signup');
Route:: post('/student/add_new_student','Student@add_new_student');

Route:: get('/student/student_login','Student@student_login');
Route:: post('/student/stud_login','Student@stud_login');

Route:: get('/student/student_dashboard','StudentOperation@student_dashboard');

Route:: get('/student/student_logout','StudentOperation@student_logout');

Route::get('/student/forget-password', 'ForgotPasswordController@getEmail');
Route::post('/student/forget-password', 'ForgotPasswordController@postEmail');

Route::get('/student/reset-password/{token}', 'ResetPasswordController@getPassword');
Route::post('/student/reset-password2', 'ResetPasswordController@updatePassword');




