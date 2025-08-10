<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(\App\Domain\Cards\CardRepositoryInterface::class, \App\Infra\Mongo\CardRepository::class);
        $this->app->singleton(\App\Domain\Activities\ActivityFeedInterface::class, \App\Infra\Redis\ActivityFeed::class);
        $this->app->bind(\App\Domain\Cards\CardServiceInterface::class, \App\Application\CardService::class);
    }

    public function boot(): void
    {
        //
    }
}
