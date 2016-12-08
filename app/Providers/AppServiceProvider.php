<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use View;
use Carbon\Carbon;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            //If the user is logged in bind it to the view
            if ($user = Auth::user()) {
                $view->with([
                    'user' => $user,
                    'current_time' => Carbon::now()
                ]);
            }

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
