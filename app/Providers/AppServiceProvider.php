<?php

namespace App\Providers;

use App\Services\MessageService;
use App\Services\MessageServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MessageServiceInterface::class, MessageService::class);
    }
}
