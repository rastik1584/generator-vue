<?php

namespace rastik1584\GeneratorVue\Traits;

use Illuminate\Support\Facades\File;

trait CreateVueGeneratorTrait
{
    private static string $resource_path = "resources/js";

    public static array $crud_files = ['Index.vue', 'Create.vue', 'Edit.vue', 'Form.vue'];

    public static function bootCreateVueGeneratorTrait()
    {
        static::$resource_path = config("generator-vue.resource_path", "resources/js");
        static::$crud_files = config("generator-vue.crud_filenames", ['Index.vue', 'Create.vue', 'Edit.vue', 'Form.vue']);
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
     * Create new file
     * @return bool
     */
    private function createNewFile(string $file_name = "default.vue")
    {
        $path = config('generator-vue.base_template_url', 'vendor\rastik1584\generator-vue-scaffolding\src\resources\templates\base_vue.vue');

        $base_path_template = base_path($path);

        if (file_exists($base_path_template)) {
            if ($file_name === "default.vue") $file_name = $this->fileName();

            return File::copy($base_path_template, $this->folderPathInCommand() . "/" . $file_name);
        }

        return false;
    }

    /**
     * return full folder path
     * @return string
     */
    protected function folderPathInCommand(): string
    {
        return base_path("$this->resource_path/" . $this->argument('path'));
    }

    /**
     * return filename
     * @return string
     */
    protected function fileName(string $name = ""): string
    {
        return $this->argument('name') . ".vue";
    }
}