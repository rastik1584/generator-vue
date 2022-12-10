<?php

namespace rastik1584\GeneratorVue\Traits;

trait BaseGeneratorTrait
{
    private static string $resource_path = "resources/js";

    public static function bootCreateVueGeneratorTrait()
    {
        static::$resource_path = config("generator-vue.paths.resource_path", "resources/js");
    }

    /**
     * Check folder is exist in structure and create them with option
     * @return bool
     */
    private function checkFolderExistOrCreate()
    {
        // create if not exist
        if ($this->option('d')) {
            !is_dir($this->folderPathInCommand()) ? mkdir($this->folderPathInCommand(), 0755) : '';
        }

        return is_dir($this->folderPathInCommand());
    }


    /**
     * Check file is exist in folder structure
     * @return bool
     */
    private function checkFileExistInFolder()
    {
        return file_exists($this->folderPathInCommand() . "/" . $this->fileName());
    }

    /**
     * return full folder path
     * @return string
     */
    protected function folderPathInCommand(): string
    {
        return base_path(static::$resource_path."/" . $this->argument('path'));
    }
    
    
}
