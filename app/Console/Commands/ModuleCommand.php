<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create module CLI';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        if (File::exists(base_path('modules/'.$name))) {
            $this->error('Module already exists!');

            return 1;
        } else {
            File::makeDirectory(base_path('modules/'.$name), 0755, true, true);

            //config
            $configFolder = base_path('modules/'.$name.'/configs');
            if (!File::exists($configFolder)) {
                try {
                    //code...
                    File::makeDirectory($configFolder, 0755, true, true);
                } catch (\Throwable $th) {
                    throw $th;
                }
            }

            //help
            $helpersFolder = base_path('modules/'.$name.'/helpers');
            if (!File::exists($helpersFolder)) {
                File::makeDirectory($helpersFolder, 0755, true, true);
            }

            //migrations


            //resources
            $resourcesFolder = base_path('modules/'.$name.'/resources');
            if (!File::exists($resourcesFolder)) {
                File::makeDirectory($resourcesFolder, 0755, true, true);

                $langFolder = base_path('modules/'.$name.'/resources/lang');
                if (!File::exists($langFolder)) {
                    File::makeDirectory($langFolder, 0755, true, true);
                }

                $viewFolder = base_path('modules/'.$name.'/resources/view');
                if (!File::exists($viewFolder)) {
                    File::makeDirectory($viewFolder, 0755, true, true);
                }
            }

            //router
            $routesFolder = base_path('modules/'.$name.'/routes');
            if (!File::exists($routesFolder)) {
                File::makeDirectory($routesFolder, 0755, true, true);

                //Tạo file router.php
                $routesFileFolder = base_path('modules/'.$name.'/routes/router');
                if (!File::exists($routesFileFolder)) {
                    File::put($routesFileFolder, '<?php');
                }
            }

            //src
            $srcFolder = base_path('modules/'.$name.'/src');
            if (!File::exists($srcFolder)) {
                File::makeDirectory($srcFolder, 0755, true, true);

                $commandFolder = base_path('modules/'.$name.'/src/Commands');
                if (!File::exists($commandFolder)) {
                    File::makeDirectory($commandFolder, 0755, true, true);
                }

                $httpFolder = base_path('modules/'.$name.'/src/Http');
                if (!File::exists($httpFolder)) {
                    File::makeDirectory($httpFolder, 0755, true, true);

                    $controllerFolder = base_path('modules/'.$name.'/src/Http/Controllers');
                    if (!File::exists($controllerFolder)) {
                        File::makeDirectory($controllerFolder, 0755, true, true);
                    }

                    $middlewareFolder = base_path('modules/'.$name.'/src/Http/Middlewares');
                    if (!File::exists($middlewareFolder)) {
                        File::makeDirectory($middlewareFolder, 0755, true, true);
                    }

                }

                $modelFolder = base_path('modules/'.$name.'/src/Models');
                if (!File::exists($modelFolder)) {
                    File::makeDirectory($modelFolder, 0755, true, true);
                }
            }

            $this->info('Module created successfully!');
        }

    }
}
