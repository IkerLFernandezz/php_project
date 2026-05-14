<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Api\SchoolApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void
    {
        $this->app->singleton(SchoolApiClient::class, function ($app) {
            return new SchoolApiClient(
                baseUrl: config('services.school_api.base_url'),
                timeout: (int) config('services.school_api.timeout', 10),
                tokenResolver: fn(): ?string => session('google_id_token'),
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
