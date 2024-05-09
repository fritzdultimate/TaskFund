<?php

namespace App\Providers;

use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Http;
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
        Http::macro('paystack', function() {
            return Http::withToken(config('app.paystack_secret_key'))
                ->baseUrl('https://api.paystack.co');
        });

        FilamentAsset::register([
            Css::make('app-stylesheet', __DIR__ . '/../../resources/css/app.css'),
            Css::make('viewer-js-css', 'https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.css'),
            Js::make('viewer-js', 'https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js'),
        ]);
    }
}
