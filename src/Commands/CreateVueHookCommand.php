<?php

namespace rastik1584\GeneratorVue\Commands;

use Illuminate\Console\Command;
use rastik1584\GeneratorVue\Traits\CreateVueGeneratorTrait;
use rastik1584\GeneratorVue\Traits\GeneratorHookTrait;

class CreateVueHookCommand extends Command
{
    use GeneratorHookTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generator-vue:make-hook {name} {--path=} {--ts} {--d}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create vue hook ';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if($this->checkFolderExistOrCreate()) {
            if($this->checkFileExistInFolder()) {
                $this->error('File exists in folder !');
                return false;
            }
            if($this->createNewHookFile(file_name: $this->fileName())) {
                $this->info('File is created successfully');
                return true;
            }

            $this->error('Base file template not exist in path: ');
            return false;
        }

        $this->error('Folder is not exist, add argument --d to create folder in structure');
        return false;
    }
}