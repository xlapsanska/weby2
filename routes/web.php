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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('resultAdmin/create', 'ResultAdminController@create')->name('resultAdmin-create');
Route::post('resultAdmin', 'ResultAdminController@store')->name('resultAdmin-store');
Route::post('/uploadfile','ResultAdminController@showUploadFile');
// Route::redirect('resultAdmin', 'ResultAdminController');
// Route::resource('resultAdmin', 'ResultAdminController');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');