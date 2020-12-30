<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Merchant\MerchantsRepository;
use App\Repositories\Merchant\MerchantsRepositoryInterface;
use App\Repositories\User\UsersRepositoryInterface;
use App\Repositories\User\UsersRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            MerchantsRepositoryInterface::class,
            MerchantsRepository::class
        );

        $this->app->bind(
            UsersRepositoryInterface::class,
            UsersRepository::class
        );
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
