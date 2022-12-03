# Generator Vue scaffolding
This package adding artisan commands to list folder structure and create vue file or vue crud in specific folder path. <br>

### Installation: 
`composer require rastik1584/generator-vue`

##### Publish the config file:
`php artisan vendor:publish --provider="rastik1584\GeneratorVue\GeneratorVueServiceProvider"`

#### Laravel version 9.*

Commands: <br>

`php artisan generator-vue:directory-list` <br>
Show directories from base path resources/js/*. Not showing files only directories. 
Added two show method list and path. Show path add option --path .

`php artisan generator-vue:make-vue <directory> <filename>` <br>
Create vue file from added directory path. Base path is resources/js . 
When directory is not exists add option --d to creating directory.

`php artisan generator-vue:make-vue-crud <directory>` <br>
Generate vue files with CRUD (Index,Create,Edit,Form) in directory path. 
When directory is not exists add option --d to create directory.


License: MIT 
