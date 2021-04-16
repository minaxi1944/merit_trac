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






