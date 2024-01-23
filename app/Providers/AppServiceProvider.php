<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Symfony\Component\Mailer\Bridge\Brevo\Transport\BrevoTransportFactory;
use Symfony\Component\Mailer\Bridge\Scaleway\Transport\ScalewayTransportFactory;
use Symfony\Component\Mailer\Transport\Dsn;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $mailer = env('MAIL_MAILER');

        if ($mailer == 'brevo') {
			Mail::extend('brevo', function () {
	            return (new BrevoTransportFactory)->create(
	                new Dsn('brevo+api', 'default', config('services.brevo.key'))
	            );
	        });
		}
        else if ($mailer == 'scaleway') {
			Mail::extend('scaleway', function () {
	            return (new ScalewayTransportFactory)->create(
	                new Dsn('scaleway+api', 'default', config('mail.mailers.scaleway.username'), config('mail.mailers.scaleway.password'))
	            );
	        });
		}

        view()->composer('*', function ($view) {
            if ($view->offsetExists('pagetitle') == false) {
                $view->with('pagetitle', env('APP_NAME'));
            }
            if ($view->offsetExists('pagedescription') == false) {
                $view->with('pagedescription', "Non si butta via niente: quello che non serve a te puoi darlo a " . env('APP_NAME') . ". Mettiamo in contatto chi opera nel sociale con chi ha qualcosa da regalare!");
            }
            if ($view->offsetExists('currentuser') == false) {
                $view->with('currentuser', Auth::user());
            }
        });

        Paginator::useBootstrapThree();
    }

    public function register()
    {
        //
    }
}
