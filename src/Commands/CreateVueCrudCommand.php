<?php

namespace rastik1584\GeneratorVue\Commands;

use Illuminate\Console\Command;
use rastik1584\GeneratorVue\Traits\CreateVueGeneratorTrait;

class CreateVueCrudCommand extends Command
{

    use CreateVueGeneratorTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generator-vue:make-vue-crud {path}
                                {--d : Create new folder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate vue crud (Index,Create,Edit,Form) from folder structure';

    private string $file_name = "";

    private int $skipped = 0;


    /**
     * Execute the console command.
     *
     *      * @return mixed
     */
    public function handle()
    {
        if ($this->checkFolderExistOrCreate()) {

            if ($this->checkAllFilesExistsInFolder()) return false;

            collect(static::$crud_files)->each(function ($name) {
                $this->file_name = "$name";

                if ($this->checkFileExistInFolder()) {
                    $this->skipped++;
                    $this->error("File $name exists in folder skipped from creating!");
                } else {
                    $this->createNewFile(file_name: $name);
                }

            });

            $this->skipped == 0
                ? $this->info("Crud files is created successfully")
                : $this->info("Skipped $this->skipped files. Other crud files is created");

            return true;
        }

        $this->error('Folder is not exist, add argument --d to create folder in structure');
        return false;
    }

    private function checkFileExistInFolder()
    {
        return file_exists($this->folderPathInCommand() . "/" . $this->file_name);
    }

    /**
     * Check count exists files, when exists count same count create files send error in cmd
     * @return bool|void
     */
    private function checkAllFilesExistsInFolder()
    {
        $count = collect(static::$crud_files)->countBy(function ($name) {
            return file_exists($this->folderPathInCommand() . "/" . $name);
        });

        if ($count->has(1) && $count->get(1) === count(static::$crud_files)) {
            $this->error("All files in folder is exists !");
            return true;
        }
    }
}