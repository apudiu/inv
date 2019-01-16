<?php

namespace App\Providers;

use App\Repositories\Client\ClientInterface;
use App\Repositories\Client\ClientRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // registering client repository
        $this->app->singleton(ClientInterface::class, ClientRepository::class);
    }
}
