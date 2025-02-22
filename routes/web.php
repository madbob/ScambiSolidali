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
    return redirect()->route('home');
});

Route::get('/home', 'CommonController@home')->name('home');
Route::get('/logo', 'CommonController@logo')->name('logo');

Route::get('/progetto', 'CommonController@project')->name('pages.project');
Route::get('/come-funziona', 'CommonController@working')->name('pages.working');
Route::get('/privacy', 'CommonController@privacy')->name('pages.privacy');
Route::get('/numeri', 'CommonController@numbers')->name('pages.numbers');
Route::get('/contatti', 'CommonController@contacts')->name('contacts');

Route::get('/celo/nuovo/{type}', 'DonationController@create')->name('celo.create');
Route::post('/celo/direct/{call_id}', 'DonationController@directResponse')->name('celo.direct');
Route::get('/celo/renew/{token}', 'DonationController@renew')->name('celo.renew');
Route::post('/celo/arenew/{id}', 'DonationController@adminRenew');

Route::get('/donazione/mie', 'DonationController@myIndex')->name('donation.mine');
Route::get('/donazione/mio/{id}', 'DonationController@getMyEdit')->name('donation.my');
Route::post('/donazione/assegna/{id}', 'DonationController@postAssign')->name('donation.assign');
Route::post('/donazione/prenota/{id}', 'DonationController@postBook');
Route::post('/donazione/detach/{type}/{donation_id}/{interaction_id}', 'DonationController@postDetach');
Route::post('/donazione/recuperato/{id}', 'DonationController@postRecovered');
Route::post('/donazione/contact/{id}', 'DonationController@postContact')->name('donation.contact');

Route::get('/register/activate/{token}', 'Auth\RegisterController@activate');
Route::get('/register/operator', 'Auth\RegisterController@registerOp')->name('register.operator');
Route::post('/register/operator', 'Auth\RegisterController@postRegisterOp');

Route::get('/giocatori', 'InstituteController@index')->name('giocatori.index');
Route::delete('/utente/elimina', 'UserController@destroyMyself')->name('user.delete');

Route::get('/gallery/{context}', 'MediaController@gallery')->name('media.gallery');

Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/giocatori/export', 'UserController@export')->name('giocatori.export');
    Route::post('/giocatori/mail', 'UserController@massiveMail')->name('giocatori.mail');
    Route::post('/giocatori/reverify/{id}', 'UserController@reverify')->name('giocatori.reverify');
    Route::get('/giocatori/bypass/{id}', 'UserController@bypass')->name('giocatori.bypass');

    Route::get('/celo/archivio', 'DonationController@getArchive')->name('celo.archive');
    Route::get('/donazione/report', 'DonationController@getReport')->name('donation.report');

    Route::resource('utenti', 'UserController');
    Route::resource('storie', 'StoryController');
});

Route::resource('celo', 'DonationController');
Route::resource('parlano-di-noi', 'MediaController');
Route::resource('ente', 'InstituteController');
Route::resource('manca', 'CallController');

Auth::routes();
