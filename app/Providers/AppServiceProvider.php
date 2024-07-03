<?php

namespace App\Providers;

use App\Interface\FacilityBillingRepositoryInterface;
use App\Interface\FacilityLocationRepositoryInterface;
use App\Interface\FacilityRepositoryInterface;
use App\Interface\FacilityTimingRepositoryInterface;
use App\Interface\FileRepositoryInterface;
use App\Repository\FacilityBillingRepository;
use App\Repository\FacilityLocationRepository;
use App\Repository\FacilityRepository;
use App\Repository\FacilityTimingRepository;
use App\Repository\FileRepository;
use Illuminate\Support\Facades\Response;
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
        $this->app->bind(FacilityRepositoryInterface::class, FacilityRepository::class);
        $this->app->bind(FacilityLocationRepositoryInterface::class, FacilityLocationRepository::class);
        $this->app->bind(FacilityBillingRepositoryInterface::class, FacilityBillingRepository::class);
        $this->app->bind(FacilityTimingRepositoryInterface::class, FacilityTimingRepository::class);
        $this->app->bind(FileRepositoryInterface::class, FileRepository::class);

        Response::macro('success', function ($data, $message = 'success', $status = 200) {
            return Response::json([
              'errors'  => false,
              'message' => $message ?? 'success',
              'data' => $data,
            ], $status);
        });

        Response::macro('error', function ($message, $status = 400) {
            return Response::json([
              'errors'  => true,
              'message' => $message,
            ], $status);
        });
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
