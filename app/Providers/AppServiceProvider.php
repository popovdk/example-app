<?php

namespace App\Providers;

use App\Package\NewsVendor\NewsApiOrgNewsVendor;
use App\Package\NewsVendor\NewsVendor;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NewsVendor::class, function (Application $app) {
            return new NewsApiOrgNewsVendor(config('services.news_api_org.api_key'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        if(config('app.https_enable')) {
            \URL::forceScheme('https');
        }
    }
}
