<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Blade;

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
        Storage::disk('public')->buildTemporaryUrlsUsing(function ($path, $expiration, $options) {
            return asset('storage/' . $path);
        });
        
        // Register the contact-card component
        Blade::component('contact-card', \App\View\Components\ContactCard::class);
    }
}