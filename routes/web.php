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
	\Illuminate\Support\Facades\Auth::logout();
    return view('auth.login');
});

Auth::routes();

Route::get('locale/{locale}',function($locale){
    Session::put('locale',$locale);
    return redirect()->back();
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('downloadPDF', 'HomeController@downloadPDF')->name('downloadPDF')->middleware('auth');
Route::get('resultAdmin', 'ResultAdminController@index')->name('resultAdmin-index')->middleware('admin')->middleware('auth');
Route::get('teamAdmin', 'TeamAdminController@index')->name('teamAdmin-index')->middleware('admin')->middleware('auth');
Route::get('resultStudent', 'ResultStudentController@index')->name('resultStudent-index')->middleware('auth');

Route::get('resultAdmin-create', 'ResultAdminController@create')->name('resultAdmin-create')->middleware('admin')->middleware('auth');
Route::get('teamAdmin-create', 'TeamAdminController@create')->name('teamAdmin-create')->middleware('admin')->middleware('auth');
Route::post('teamPoint-store', 'TeamPointController@store')->name('teamPoint-store')->middleware('admin')->middleware('auth');
Route::post('pointStudent-agree', 'TeamStudentController@agree')->name('pointStudent-agree')->middleware('auth');
Route::get('pointStudent-create', 'TeamStudentController@create')->name('pointStudent-create')->middleware('auth');
Route::post('pointStudent-store', 'TeamStudentController@store')->name('pointStudent-store')->middleware('auth');

Route::get('teamPoint-create/{team_fk}', 'TeamPointController@create')->name('teamPoint-create')->middleware('admin')->middleware('auth');
Route::post('teamPoint-csv', 'TeamPointController@downloadCSV')->name('teamPoint-csv')->middleware('auth');
Route::get('teamPointAll-create', 'TeamPointController@edit')->name('teamPointAll-create')->middleware('admin')->middleware('auth');
Route::post('teamPointAll-agree', 'TeamPointController@agree')->name('teamPointAll-agree')->middleware('admin')->middleware('auth');
Route::post('resultAdmin', 'ResultAdminController@store')->name('resultAdmin-store')->middleware('admin')->middleware('auth');
Route::post('/uploadfile','ResultAdminController@showUploadFile')->middleware('auth');
Route::post('/uploadfileteam','TeamAdminController@showUploadFile')->middleware('auth');
Route::delete('deleteSubject/{id}','ResultAdminController@deleteSubject')->name('deleteSubject')->middleware('auth');
Route::get('/pdf/{id}','ResultAdminController@exportPdf')->middleware('auth');

Route::get('mailAdmin-create', 'MailController@create')->name('mailAdmin-create')->middleware('admin')->middleware('auth');
Route::post('/mailUpload','MailController@showUploadFile')->middleware('admin','auth');
Route::post('mailAdmin-create','MailController@sendMail')->middleware('admin','auth');
Route::view('/summernote','summernote');

//summernote store route
Route::post('/summernote','SummernoteController@store')->name('summernotePersist');

//summernote display route
Route::get('/summernote_display','SummernoteController@show')->name('summernoteDispay');

// Route::redirect('resultAdmin', 'ResultAdminController');
// Route::resource('resultAdmin', 'ResultAdminController');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
