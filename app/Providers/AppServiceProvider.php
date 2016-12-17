<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use View;
use Carbon\Carbon;
use Config;
use App\Mastery;

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
                $masteries = Mastery::orderBy('name')->get();
                $view->with([
                    'user' => $user,
                    'masteries' => $masteries,
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
