<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

use App\Services\WatchLaterService;
use App\Services\VideoProviderFactory;

use App\Services\VideoProviders\YouTubeProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registriere die Factory
        $this->app->singleton(VideoProviderFactory::class, function ($app) {
            $factory = new VideoProviderFactory();

            // Registriere alle Provider
            $factory->registerProvider(new YouTubeProvider());

            return $factory;
        });

        // Registriere den Hauptservice
        $this->app->singleton(WatchLaterService::class, function ($app) {
            return new WatchLaterService(
                $app->make(VideoProviderFactory::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading();
    }
}
