<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        if (config('app.env') !== 'production'){
            \DB::listen(function($query){
                \Log::info("Query Time:{$query->time}s] $query->sql");
            });
        }
        elseif (config('app.env') === 'production'){
            \URL::forceScheme('https');
        }
        elseif (\App::environment('production')){// 本番環境(Heroku)でhttpsを強制する 
            \URL::forceScheme('https');
        }
        Schema::defaultStringLength(191);
    }
}
