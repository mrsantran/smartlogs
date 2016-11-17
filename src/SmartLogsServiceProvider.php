<?php

namespace SanTran\SmartLogs;

use Illuminate\Support\ServiceProvider;

class SmartLogsServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__ . '/config/smartlogs.php' => config_path('smartlogs.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('smartlogs', function () {
            return new SmartLogs();
        });
        $this->app->alias('smartlogs', 'SanTran\SmartLogs\SmartLogs');
    }

}
