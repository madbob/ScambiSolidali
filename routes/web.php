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

Route::get(substr(env('APP_KEY'), -5) . '/logs', '\MadBob\LaravelLog2Rss\Log2RssController@index');

Route::get('/home', 'CommonController@home');
Route::get('/progetto', 'CommonController@project');
Route::get('/come-funziona', 'CommonController@working');
Route::get('/privacy', 'CommonController@privacy');
Route::get('/numeri', 'CommonController@numbers');
Route::get('/contatti', 'CommonController@contacts');

Route::get('/celo/nuovo/{type}', 'DonationController@create');
Route::get('/celo/renew/{token}', 'DonationController@renew');
Route::post('/celo/arenew/{id}', 'DonationController@adminRenew');
Route::get('/celo/archivio', 'DonationController@getArchive');

Route::get('/donazione/image/{id}/{index}', 'DonationController@getImage');
Route::get('/donazione/mie', 'DonationController@myIndex');
Route::get('/donazione/mio/{id}', 'DonationController@getMyEdit');
Route::post('/donazione/assegna/{id}', 'DonationController@postAssign');
Route::post('/donazione/prenota/{id}', 'DonationController@postBook');
Route::post('/donazione/detach/{type}/{donation_id}/{interaction_id}', 'DonationController@postDetach');
Route::post('/donazione/recuperato/{id}', 'DonationController@postRecovered');
Route::get('/donazione/report', 'DonationController@getReport');

Route::get('/register/activate/{token}', 'Auth\RegisterController@activate');
Route::get('/register/operator', 'Auth\RegisterController@registerOp');
Route::post('/register/operator', 'Auth\RegisterController@postRegisterOp');

Route::post('/giocatori/mail', 'UserController@massiveMail')->name('giocatori.mail');

Route::get('/periodico/prenota', 'RecurringController@booking')->name('periodico.prenota');
Route::post('/periodico/prenota', 'RecurringController@saveBooking')->name('periodico.prenotazione');
Route::post('/periodico/reset/weekly', 'RecurringController@resetWeekly')->name('periodico.reset_weekly');
Route::post('/periodico/reset/monthly', 'RecurringController@resetMonthly')->name('periodico.reset_monthly');

Route::resource('/celo', 'DonationController');
Route::resource('/giocatori', 'UserController');
Route::resource('/parlano-di-noi', 'MediaController');
Route::resource('/storie', 'StoryController');
Route::resource('/archivio', 'ArchiveController');
Route::resource('/ente', 'InstituteController');
Route::resource('/azienda', 'CompanyController');
Route::resource('/manca', 'CallController');
Route::resource('/periodico', 'RecurringController');

Auth::routes();
