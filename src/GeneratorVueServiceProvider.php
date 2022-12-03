<?php

namespace rastik1584\GeneratorVue;

use Illuminate\Support\ServiceProvider;
use rastik1584\GeneratorVue\Commands\CreateVueCrudCommand;
use rastik1584\GeneratorVue\Commands\CreateVueFileCommand;
use rastik1584\GeneratorVue\Commands\DirectoryListCommand;

class GeneratorVueServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            DirectoryListCommand::class,
            CreateVueFileCommand::class,
            CreateVueCrudCommand::class,
        ]);

        $this->publishes([
            __DIR__ . '/../config/generator-vue.php' => config_path('generator-vue.php'),
        ]);
    }


}