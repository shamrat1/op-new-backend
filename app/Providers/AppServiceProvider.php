<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use View;
Use Auth;

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
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Blade::if('role',function($roles){

            if (auth()->user() && auth()->user()->hasAnyRole($roles)){
                return true;
            }
            return false;
        });

        \Validator::extendImplicit('current_password',function($attribute, $value, $parameters, $validator)
            {
                return \Hash::check($value, auth()->user()->password);
            });
    }
}
