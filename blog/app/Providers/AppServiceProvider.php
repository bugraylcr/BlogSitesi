<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// burada sql ile laravel uyumu için 
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // karakter uyuşmazlığını engellemek için 
        Schema::defaultStringLength(191);
    }
}
