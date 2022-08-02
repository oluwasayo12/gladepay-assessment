<?php

namespace App\Providers;

use App\Contracts\CompaniesInterface;
use App\Contracts\EmployeesInterface;
use App\Services\CompaniesService;
use App\Services\EmployeeService;
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
        $this->app->bind(EmployeesInterface::class, EmployeeService::class);
        $this->app->bind(CompaniesInterface::class, CompaniesService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
