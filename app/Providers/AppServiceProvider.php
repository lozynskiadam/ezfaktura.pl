<?php

namespace App\Providers;

use App\Services\ApiService;
use App\Services\ContractorService;
use App\Services\InvoiceService;
use App\Services\SignatureService;
use Illuminate\Support\Facades\DB;
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
        $this->app->bind(ApiService::class);
        $this->app->bind(SignatureService::class);
        $this->app->bind(ContractorService::class);
        $this->app->bind(InvoiceService::class, function ($app) {
            return new InvoiceService($app->make(SignatureService::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(env('APP_DEBUG')) {
            DB::connection()->enableQueryLog();
        }
    }
}
