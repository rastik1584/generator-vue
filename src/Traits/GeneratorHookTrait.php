<?php

namespace rastik1584\GeneratorVue\Traits;

use Illuminate\Support\Facades\File;

trait GeneratorHookTrait
{
    use BaseGeneratorTrait;

    private static string $base_path_template = 'vendor\rastik1584\generator-vue\src\resources\templates\base_hook_js.js';


    public static function bootGeneratorHookTrait()
    {
        $path = static::option('ts') ?
            config('generator-vue.templates.base_hook_ts_template', 'vendor\rastik1584\generator-vue\src\resources\templates\base_hook_ts.ts') :
            config('generator-vue.templates.base_hook_js_template', 'vendor\rastik1584\generator-vue\src\resources\templates\base_hook_js.js');
        static::$base_path_template = base_path($path);
    }

    /**
     * create new hook file
     * @param string $file_name
     * @return bool
     */
    private function createNewHookFile(string $file_name = 'hook_base_template'): bool
    {
        if(file_exists(static::$base_path_template)) {
            if ($file_name === "hook_base_template") $file_name = $this->fileName();

            return File::copy(static::$base_path_template, $this->folderPathInCommand() . "/" . $file_name);
        }
        return false;
    }

    /**
     * return filename
     * @param string $name
     * @return string
     */
    private function fileName(string $name = ""): string
    {
        $extension = $this->option('ts') ? '.ts' : '.js';

        if($name == "") return strpos($extension, $this->argument('name')) !== false ? $this->argument('name') : $this->argument('name'). $extension;

        return strpos($extension, $name) !== false ? $name : $name . $extension;
    }

    /**
     * return full folder path
     * @return string
     */
    protected function folderPathInCommand(): string
    {
        return base_path(static::$resource_path."/hooks/" . $this->option('path'));
    }

}