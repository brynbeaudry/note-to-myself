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
    return view('auth.login');
});

Auth::routes();
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

Route::resource('/notes', "NoteController");
Route::resource('/websites', "WebsiteController");
Route::resource('/images', "ImageController");
Route::resource('/tdbs', "TBDController");

Route::get('/home', 'HomeController@index');
Route::post('/home', 'HomeController@save');
