<?php

namespace App\Providers;

use App\Models\Divisi;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer(['partials.admin.sidebar', 'partials.pengurus.sidebar'], function ($view) {
            $view->with('semua_divisi', Divisi::all());
        });
    }
}
