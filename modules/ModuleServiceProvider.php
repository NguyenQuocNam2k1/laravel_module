<?php
namespace Modules;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Modules\User\src\Commands\UserCommand;
use Modules\User\src\Http\Middlewares\DemoMiddleware;

class ModuleServiceProvider extends ServiceProvider {

    //khai bao cac middleware can dang ky
    private $middleware = [
        'demo' => DemoMiddleware::class
    ];

    //Khai bao cac command can dang ky
    private $command = [
        UserCommand::class
    ];

    public function boot() 
    {
        $modules = $this->getModules();
        if (!empty($modules)) {
            foreach ($modules as $module) {
                 $this->registerModule($module);
            }
        }
    }

    public function register()
    {
        
        //config
        $modules = $this->getModules();
        if (!empty($modules)) {
            foreach ($modules as $module) {
                $this->registerConfig($module);
           }
        }
        // $directories = array_map('basename', File::directories(__DIR__));
        // if(!empty($directories)) {
        //     foreach ($directories as $directory) {
        //         $configPath = __DIR__ .'/'. $directory."/configs";
        //         if (File::exists($configPath)) {
        //             $configFiles = array_map('basename', File::allFiles("$configPath"));
        //             foreach ($configFiles as $path) {
        //                 $alias = pathinfo(basename($path), PATHINFO_FILENAME);
        //                 $this->mergeConfigFrom($configPath .'/'.$path, $alias);
        //             }
        //         }
        //     }
        // }

        //middleware
        $this->registerMiddleware($this->middleware);

        //command
        $this->registerCommand($this->command);
    }

    // get module
    private function getModules() {
        return array_map('basename', File::directories(__DIR__));
    }

    //Register module
    private function registerModule($module) {
        $modulePath = __DIR__."/{$module}/";
        //Khai báo router
        if (File::exists($modulePath . "routes/routes.php")) {
            $this->loadRoutesFrom($modulePath . "routes/routes.php");
        }

        //Khai bao migration
        if (File::exists($modulePath . "migrations")) {
            $this->loadMigrationsFrom($modulePath . "migrations");
        }

        //Khai bao language
        if (File::exists($modulePath . "resources/lang")) {

            $this->loadTranslationsFrom($modulePath . "resources/lang" , $module);

            $this->loadJsonTranslationsFrom($modulePath . "resources/lang");
            
        }

        //Khai bao view
        if (File::exists($modulePath . "resources/view")) {
            $this->loadViewsFrom($modulePath . "resources/view" , $module);
        }

        //Khai bao helper
        if (File::exists($modulePath . "/helpers")) {
            $helperList = File::allFiles($modulePath . "/helpers"); //get all file in folder helper
            if (!empty($helperList)) {
                foreach ($helperList as $helper) {
                    $file = $helper->getPathName();
                    require $file;
                }
            }
        }
    }

    //register config
    private function registerConfig($module) {
        $configPath = __DIR__ .'/'. $module."/configs";
        if (File::exists($configPath)) {
            $configFiles = array_map('basename', File::allFiles("$configPath"));
            foreach ($configFiles as $path) {
                $alias = pathinfo(basename($path), PATHINFO_FILENAME);
                $this->mergeConfigFrom($configPath .'/'.$path, $alias);
            }
        }
    }

    //register middleware
    private function registerMiddleware($middleware) {
        if(!empty($middleware)) {
            foreach ($middleware as $key => $middleware) {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }

    //register command 
    private function registerCommand($listCommand) {
        $this->commands($listCommand);
    }
}