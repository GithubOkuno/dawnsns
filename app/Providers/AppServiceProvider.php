<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Follow;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view)
        {
            $view->with('countfollow', Follow::where('follower', auth()->id())->count());
            $view->with('countfollower', Follow::where('follow', auth()->id())->count());
        });
    }
}
