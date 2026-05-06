<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\Api\SchoolApiClient::class, function () {
            return new \App\Services\Api\SchoolApiClient(
                baseUrl: config('school_api.base_url'),
                timeout: config('school_api.timeout'),
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
