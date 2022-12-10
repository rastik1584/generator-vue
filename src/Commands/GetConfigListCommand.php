<?php

namespace rastik1584\GeneratorVue\Commands;

use Illuminate\Console\Command;
use rastik1584\GeneratorVue\Traits\CreateVueGeneratorTrait;

class GetConfigListCommand extends Command
{
    use CreateVueGeneratorTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generator-vue:get-config-list {--all} {--template}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Return list in config resource paths, template paths etc.';


    /**
     * Execute the console command.
     *
     *      * @return mixed
     */
    public function handle()
    {
        if($this->option('all')) { // show all from config
            $this->configAllList();
        } elseif ($this->option('template')) { // only templates paths
            $this->sendConfigInCmd(config('generator-vue.templates'));
        } else {
            $this->sendConfigInCmd(config('generator-vue.paths')); // only other paths
        }
    }



    private function configAllList()
    {
        $config = config('generator-vue');
        collect($config)->each(function ($path, $key) {
            if(is_array($path)) {
                $this->info("$key:");
                $this->sendConfigInCmd($path);
                $this->newLine();
            } else {
                $this->sendConfigInCmd($config);
            }
        });
    }

    protected function sendConfigInCmd($config)
    {
        collect($config)->each(function ($path, $key) {
            $this->info("$key - $path");
        });
    }
}