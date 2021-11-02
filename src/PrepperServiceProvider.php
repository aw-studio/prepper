<?php

namespace AwStudio\Prepper;

use AwStudio\Prepper\Commands\InstallCommand;
use AwStudio\Prepper\Commands\LocalizeCommand;
use AwStudio\Prepper\Commands\PublishCommand;
use AwStudio\Prepper\Commands\SeedCommand;
use Illuminate\Support\ServiceProvider;

class PrepperServiceProvider extends ServiceProvider
{
    /**
     * Register application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCommands();
    }

    /**
     * Register Deeplable command.
     *
     * @return void
     */
    public function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                PublishCommand::class,
                SeedCommand::class,
                LocalizeCommand::class,
            ]);
        }
    }
}
