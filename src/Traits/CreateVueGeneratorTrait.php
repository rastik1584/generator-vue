<?php

namespace rastik1584\GeneratorVue\Traits;

use Illuminate\Support\Facades\File;

trait CreateVueGeneratorTrait
{
    use BaseGeneratorTrait;
    
    public static array $crud_files = ['Index.vue', 'Create.vue', 'Edit.vue', 'Form.vue'];

    public static function bootCreateVueGeneratorTrait()
    {
        static::$crud_files = config("generator-vue.vue_crud_filenames", ['Index.vue', 'Create.vue', 'Edit.vue', 'Form.vue']);
    }

    /**
     * Create new file
     * @return bool
     */
    private function createNewFile(string $file_name = "default.vue")
    {
        $path = config('generator-vue.templates.base_vue_template', 'vendor\rastik1584\generator-vue\src\resources\templates\base_vue.vue');

        $base_path_template = base_path($path);

        if (file_exists($base_path_template)) {
            if ($file_name === "default.vue") $file_name = $this->fileName();

            return File::copy($base_path_template, $this->folderPathInCommand() . "/" . $file_name);
        }

        return false;
    }

    /**
     * return filename
     * @return string
     */
    protected function fileName(string $name = ""): string
    {
        if($name === "") return strpos(".vue", $this->argument('name')) !== false ? $this->argument('name') : $this->argument('name') . ".vue";
        return strpos(".vue", $name) !== false ? $name : "$name.vue";
    }
}