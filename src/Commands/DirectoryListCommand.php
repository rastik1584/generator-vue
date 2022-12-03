<?php

namespace rastik1584\GeneratorVue\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class DirectoryListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generator-vue-scaffolding:directory-list {--path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Return directories with resources/js';

    private string $scan_dir = 'resources/js';

    /**
     * Execute the console command.
     *
     *      * @return mixed
     */
    public function handle()
    {
        $this->info('Folder structure :');

        $this->getFolderList($this->scan_dir)->map(function ($dir) {

             $this->option('path') ? $this->pathStyleDirectories(collect([$dir])) : $this->listStylePadding(1,$dir);

             $this->getFolderList("$this->scan_dir/$dir")->map(function ($subdir) use ($dir) {
                 $this->option('path') ? $this->pathStyleDirectories(collect([$dir, $subdir])) : $this->listStylePadding(2, $subdir);

                 $this->getFolderList("$this->scan_dir/$dir/$subdir")->map(function ($lvl_three_dir) use($dir, $subdir) {
                     $this->option('path') ? $this->pathStyleDirectories(collect([$dir, $subdir, $lvl_three_dir])) : $this->listStylePadding(3, $lvl_three_dir);

                     $this->getFolderList("$this->scan_dir/$dir/$subdir/$lvl_three_dir")->map(function ($lvl_four_dir) use($dir, $subdir, $lvl_three_dir) {
                         $this->option('path') ? $this->pathStyleDirectories(collect([$dir, $subdir, $lvl_three_dir, $lvl_four_dir])) : $this->listStylePadding(4,$lvl_four_dir);;
                     });
                 });
             });
        });

    }


    /**
     * Return folders in path
     * @param string $scan_dir
     * @return Collection
     */
    private function getFolderList(string $scan_dir): Collection
    {
        return collect(array_diff(scandir($scan_dir), ['.', '..']))
            ->filter(function ($subdir) {
                preg_match('/.js|.vue|.css/', $subdir, $is_dir);
                return empty($is_dir);
            });
    }

    /**
     * List style folder structure
     * @param int $level
     * @param string $string
     * @return void
     */
    private function listStylePadding(int $level,string $string)
    {
        switch ($level) {
            case 1:
                return $this->line("$string");
            case 2:
                return $this->line("  --$string");
            case 3:
                return $this->line("    --$string");
            case 4:
                return $this->line("      --$string");
            default:
                return $this->line($string);
        }

    }

    /**
     * Path style folder structure
     * @param Collection $collection
     * @return void
     */
    private function pathStyleDirectories(Collection $collection)
    {
        return $this->line($collection->implode("/"));
    }

}