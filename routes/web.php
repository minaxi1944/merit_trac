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

Route::get('/admin','Admin@index');
Route::get('/admin/subject_creation','Admin@subject_creation');

Route::post('/admin/add_new_subject','Admin@add_new_subject');

Route::get('/admin/delete_subject/{subject_name}','Admin@delete_subject');
Route::get('/admin/edit_subject/{subject_name}','Admin@edit_subject');
Route::post('admin/edit_new_subject','Admin@edit_new_subject');






