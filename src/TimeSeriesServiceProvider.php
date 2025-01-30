<?php

namespace TimothePearce\TimeSeries;

use TimothePearce\TimeSeries\Services\DefaultWeekInfoService;
use Illuminate\Support\ServiceProvider;
use TimothePearce\TimeSeries\Services\RecalculationWeeksService;
use TimothePearce\TimeSeries\Contracts\RecalculationWeeksContract;
use TimothePearce\TimeSeries\Commands\CreateProjectionCommand;
use TimothePearce\TimeSeries\Commands\DropProjectionsCommand;
use TimothePearce\TimeSeries\Commands\ProjectModelsCommand;
use TimothePearce\TimeSeries\Contracts\WeekInfoContract;

class TimeSeriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstraps the package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/time-series.php' => config_path('time-series.php'),
        ], 'time-series-config');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateProjectionCommand::class,
                DropProjectionsCommand::class,
                ProjectModelsCommand::class,
            ]);
        }
    }

    /**
     * Registers any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/time-series.php',
            'time-series'
        );

        $this->app->singleton(TimeSeries::class, function () {
            return new TimeSeries();
        });

        if(!$this->app->bound(WeekInfoContract::class)){
            $this->app->bind(WeekInfoContract::class, DefaultWeekInfoService::class);
        }

        if(!$this->app->bound(RecalculationWeeksContract::class)){
            $this->app->bind(RecalculationWeeksContract::class, RecalculationWeeksService::class);
        }

    }
}
