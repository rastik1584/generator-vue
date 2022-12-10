# Generator Vue
This package adding artisan commands to list folder structure and create vue file or vue crud in specific folder path. <br>

### Installation: 
`composer require rastik1584/generator-vue`

##### Publish the config file:
`php artisan vendor:publish --provider="rastik1584\GeneratorVue\GeneratorVueServiceProvider"`

#### Laravel version 9.*

### Commands: <br>

`php artisan generator-vue:directory-list {--path}` <br>
Show directories from base path resources/js/*. Not showing files only directories. 
Added two show method list and path. Show path add option --path .

`php artisan generator-vue:make-vue <directory> <filename> {--d}` <br>
Create vue file from added directory path. Base path is resources/js . 
When directory is not exists add option --d to creating directory.

`php artisan generator-vue:make-vue-crud <directory> {--d}` <br>
Generate vue files with CRUD (Index,Create,Edit,Form) in directory path. 
When directory is not exists add option --d to create directory.

#### Version 1.1:
<p>Update config file to separate paths and templates, add crud vue filenames. Add new commands.</p>

##### Added this new commands:
`php artisan generator-vue:get-config-list {--all} {--template}` <br>
Return config settings. From base ( no options ) return only paths. Template option return only base template paths
All option return all settings in config file. 

`php artisan generator-vue:make-hook <name> {--path=} {--ts} {--d}` <br>
Generate hook file from resource path add /hooks folder and base creating .js hook. Optional --path generate exists or create new folder structure from hooks.
Option --d from creating new folders. --ts option generate TypeScript hook. 




License: MIT 
