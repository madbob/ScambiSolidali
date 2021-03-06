<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use Auth;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
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
