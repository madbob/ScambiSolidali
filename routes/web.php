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
Route::get('/progetto', 'CommonController@project');
Route::get('/come-funziona', 'CommonController@working');
Route::get('/numeri', 'CommonController@numbers');
Route::get('/contatti', 'CommonController@contacts');

Route::get('/celo/nuovo/{type}', 'DonationController@create');

Route::get('/donazione/image/{id}/{index}', 'DonationController@getImage');
Route::get('/donazione/mie', 'DonationController@myIndex');
Route::post('/donazione/assegna/{id}', 'DonationController@postAssign');
Route::post('/donazione/prenota/{id}', 'DonationController@postBook');
Route::post('/donazione/recuperabile/{id}', 'DonationController@postRecoverable');
Route::get('/register/activate/{token}', 'Auth\RegisterController@activate');
Route::get('/register/operator', 'Auth\RegisterController@registerOp');
Route::post('/register/operator', 'Auth\RegisterController@postRegisterOp');

Route::resource('/celo', 'DonationController');
Route::resource('/giocatori', 'UserController');
Route::resource('/parlano-di-noi', 'MediaController');
Route::resource('/fruitore', 'ReceiverController');
Route::resource('/archivio', 'ArchiveController');
Route::resource('/ente', 'InstituteController');
Route::resource('/manca', 'CallController');

Auth::routes();
