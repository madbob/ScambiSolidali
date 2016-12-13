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
    return redirect(url('/home'));
});

Route::get('/home', 'CommonController@home');
Route::get('/donazione/image/{id}', 'DonationController@getImage');
Route::post('/donazione/assegna/{id}', 'DonationController@postAssign');
Route::post('/donazione/prenota/{id}', 'DonationController@postBook');

Route::resource('/donazione', 'DonationController');
Route::resource('/utente', 'UserController');
Route::resource('/fruitore', 'ReceiverController');
Route::resource('/archivio', 'ArchiveController');

Auth::routes();
