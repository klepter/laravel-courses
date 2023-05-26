<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

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
        Validator::extend('cyrillic', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/[А-Яа-яЁё]/u', $value);
        });
    }
}
