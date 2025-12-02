<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SpotifyService;

class AppServiceProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SpotifyService::class, function ($app) {
            return new SpotifyService(
                env('SPOTIFY_CLIENT_ID'),
                env('SPOTIFY_CLIENT_SECRET')
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
