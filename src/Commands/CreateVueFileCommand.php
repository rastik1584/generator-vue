<?php

namespace rastik1584\GeneratorVue\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use rastik1584\GeneratorVue\Traits\CreateVueGeneratorTrait;

class CreateVueFileCommand extends Command
{
    use CreateVueGeneratorTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generator-vue:make-vue {path} {name}
                                {--d : Create new folder}
                                {--crud}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate vue file/files from folder structure';


    /**
     * Execute the console command.
     *
     *      * @return mixed
     */
    public function handle()
    {
        if ($this->checkFolderExistOrCreate()) {
            if ($this->checkFileExistInFolder()) {
                $this->error('File exists in folder !');
                return false;
            }

            if ($this->option('crud')) {
                collect(static::$crud_files)->each(function ($name) {
                    $this->createNewFile(file_name: $name);
                });
                $this->info("Crud files is created successfully");
                return true;
            }

            if($this->createNewFile(file_name: $this->fileName())) {
                $this->info('File is created successfully');
                return true;
            }
            $this->error('Base file template not exist in path: '.static::$resource_path." ".$this->argument('path'));
            return false;
        }

        $this->error('Folder is not exist, add argument --d to create folder in structure');
        return false;
    }


}