<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Client;
use App\Models\File;
use App\Models\Address;
use App\Models\Passport;
use App\Models\Company;
use App\Models\Branch;
use App\Observers\ClientObserver;
use App\Observers\FileObserver;
use App\Observers\AddressObserver;
use App\Observers\PassportObserver;
use App\Observers\CompanyObserver;
use App\Observers\BranchObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // Client::observe(ClientObserver::class);
        // File::observe(FileObserver::class);
        // Address::observe(AddressObserver::class);
        // Passport::observe(PassportObserver::class);
        // Company::observe(CompanyObserver::class);
        // Branch::observe(BranchObserver::class);
        
        // Laravel Pagination use Bootstrap
        Paginator::useBootstrap();
        // \Debugbar::disable();

        // Connect Helpers
        foreach (glob(__DIR__.'/../Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
}
