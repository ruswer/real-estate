<?php

namespace App\Providers;

use App\Models\Property;
use App\Models\PropertyType;
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
        View::composer('*', function ($view) {
            $view->with('propertyTypes', PropertyType::all());
            $view->with('locations', Property::distinct()->pluck('location'));
        });
    }
}
