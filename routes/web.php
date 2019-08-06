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

Route::get('/home', 'CommonController@home')->name('home');
Route::get('/logo', 'CommonController@logo')->name('logo');
Route::get('/maincss', 'CommonController@css')->name('css');

Route::get('/progetto', 'CommonController@project');
Route::get('/come-funziona', 'CommonController@working');
Route::get('/privacy', 'CommonController@privacy');
Route::get('/numeri', 'CommonController@numbers');
Route::get('/contatti', 'CommonController@contacts')->name('contacts');

Route::get('/celo/nuovo/{type}', 'DonationController@create');
Route::post('/celo/direct/{call_id}', 'DonationController@directResponse')->name('celo.direct');
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
Route::post('/donazione/contact/{id}', 'DonationController@postContact')->name('donation.contact');

Route::get('/register/activate/{token}', 'Auth\RegisterController@activate');
Route::get('/register/operator', 'Auth\RegisterController@registerOp');
Route::post('/register/operator', 'Auth\RegisterController@postRegisterOp');

Route::get('/giocatori/export', 'UserController@export')->name('giocatori.export');
Route::post('/giocatori/mail', 'UserController@massiveMail')->name('giocatori.mail');
Route::post('/giocatori/reverify/{id}', 'UserController@reverify')->name('giocatori.reverify');

Route::get('/food', 'CommonController@food')->name('food');
Route::get('/food/progetto', 'CommonController@foodProject')->name('food.progetto');
Route::get('/food/come-funziona', 'CommonController@foodWorking')->name('food.come-funziona');
Route::get('/food/giocatori', 'CommonController@foodPlayers')->name('food.giocatori');
Route::get('/food/numeri', 'CommonController@foodNumbers')->name('food.numeri');
Route::get('/food/contatti', 'CommonController@foodContacts')->name('food.contacts');

Route::get('/periodico/prenota', 'RecurringController@booking')->name('periodico.prenota');
Route::post('/periodico/prenota', 'RecurringController@saveBooking')->name('periodico.prenotazione');
Route::post('/periodico/reset/weekly', 'RecurringController@resetWeekly')->name('periodico.reset_weekly');
Route::post('/periodico/reset/monthly', 'RecurringController@resetMonthly')->name('periodico.reset_monthly');
Route::get('/periodico/archivio', 'RecurringController@archive')->name('periodico.archivio');

Route::get('/casa', 'CommonController@house')->name('house');

Route::resource('celo', 'DonationController');
Route::resource('giocatori', 'UserController');
Route::resource('parlano-di-noi', 'MediaController');
Route::resource('storie', 'StoryController');
Route::resource('archivio', 'ArchiveController');
Route::resource('ente', 'InstituteController');
Route::resource('azienda', 'CompanyController');
Route::resource('manca', 'CallController');
Route::resource('periodico', 'RecurringController');

Auth::routes();
