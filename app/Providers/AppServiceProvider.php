<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Routing\UrlGenerator;

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
    //public function boot(UrlGenerator $url)
    {
        if (config('app.env') !== 'production'){
            \DB::listen(function($query){
                \Log::info("Query Time:{$query->time}s] $query->sql");
            });
        }
        /*
        if (request()->isSecure()) {// 本番環境(Heroku)でhttpsを強制する
            \URL::forceScheme('https');
        }
        */
        /*
        elseif (env('REDIRECT_HTTPS')) {// 本番環境(Heroku)でhttpsを強制する
            $url->forceScheme('https');
        }
        elseif (app()->environment('production')) {// 本番環境(Heroku)でhttpsを強制する
            $url->forceScheme('https');
        }
        
        elseif (config('app.env') === 'production'){// 本番環境(Heroku)でhttpsを強制する
            \URL::forceScheme('https');
        }
        elseif (\App::environment('production')){// 本番環境(Heroku)でhttpsを強制する 
            \URL::forceScheme('https');
        }
        */

        Schema::defaultStringLength(191);
    }
}
