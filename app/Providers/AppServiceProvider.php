<?php

namespace App\Providers;

use App\InvoiceRecur;
use App\Repositories\Client\ClientInterface;
use App\Repositories\Client\ClientRepository;
use App\Repositories\Invoice\InvoiceInterface;
use App\Repositories\Invoice\InvoiceRepository;
use App\Repositories\Person\PersonInterface;
use App\Repositories\Person\PersonRepository;
use App\Repositories\Project\ProjectInterface;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Recur\RecurringInterface;
use App\Repositories\Recur\RecurringRepository;
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

        // registering person repository
        $this->app->singleton(PersonInterface::class, PersonRepository::class);

        // registering invoice repository
        $this->app->singleton(InvoiceInterface::class, InvoiceRepository::class);

        // registering Project repository
        $this->app->singleton(ProjectInterface::class, ProjectRepository::class);

        // registering Invoice Recurring repository
        $this->app->singleton(RecurringInterface::class, RecurringRepository::class);

    }
}
