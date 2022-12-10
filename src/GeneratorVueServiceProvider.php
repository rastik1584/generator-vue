<?php

namespace rastik1584\GeneratorVue;

use Illuminate\Support\ServiceProvider;
use rastik1584\GeneratorVue\Commands\CreateVueCrudCommand;
use rastik1584\GeneratorVue\Commands\CreateVueFileCommand;
use rastik1584\GeneratorVue\Commands\CreateVueHookCommand;
use rastik1584\GeneratorVue\Commands\DirectoryListCommand;
use rastik1584\GeneratorVue\Commands\GetConfigListCommand;

class GeneratorVueServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            DirectoryListCommand::class,
            CreateVueFileCommand::class,
            CreateVueCrudCommand::class,
            GetConfigListCommand::class,
            CreateVueHookCommand::class,
        ]);

        $this->publishes([
            __DIR__ . '/../config/generator-vue.php' => config_path('generator-vue.php'),
        ]);
    }


}