<?php

namespace Dasteem\Laragenerators;

use Illuminate\Support\ServiceProvider;
use Dasteem\Laragenerators\Commands\LaraGeneratorsConfig;
use Dasteem\Laragenerators\Commands\LaraGeneratorsInstall;

class LarageneratorsServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register vendor views
        $this->loadViewsFrom(__DIR__ . DIRECTORY_SEPARATOR . 'Views'. DIRECTORY_SEPARATOR .'qa', 'qa');
        $this->loadViewsFrom(__DIR__ . DIRECTORY_SEPARATOR . 'Views'. DIRECTORY_SEPARATOR .'templates', 'tpl');
        /* Publish master templates */
        $this->publishes([
            __DIR__ . DIRECTORY_SEPARATOR . 'Config'. DIRECTORY_SEPARATOR .'laragenerators.php'                  => config_path('laragenerators.php'),
            __DIR__ . DIRECTORY_SEPARATOR . 'Views'. DIRECTORY_SEPARATOR .'admin'                            => base_path('resources'. DIRECTORY_SEPARATOR .'views'. DIRECTORY_SEPARATOR .'admin'),
            __DIR__ . DIRECTORY_SEPARATOR . 'Views'. DIRECTORY_SEPARATOR .'auth'                             => base_path('resources'. DIRECTORY_SEPARATOR .'views'. DIRECTORY_SEPARATOR .'auth'),
            __DIR__ . DIRECTORY_SEPARATOR . 'Views'. DIRECTORY_SEPARATOR .'emails'                           => base_path('resources'. DIRECTORY_SEPARATOR .'views'. DIRECTORY_SEPARATOR .'emails'),
            __DIR__ . DIRECTORY_SEPARATOR . 'Public'. DIRECTORY_SEPARATOR .'laragenerators'                      => base_path('public'. DIRECTORY_SEPARATOR .'laragenerators'),
            __DIR__ . DIRECTORY_SEPARATOR . 'Controllers'. DIRECTORY_SEPARATOR .'publish'. DIRECTORY_SEPARATOR .'UsersController'    => app_path('Http'. DIRECTORY_SEPARATOR .'Controllers'. DIRECTORY_SEPARATOR .'UsersController.php'),
            __DIR__ . DIRECTORY_SEPARATOR . 'Controllers'. DIRECTORY_SEPARATOR .'publish'. DIRECTORY_SEPARATOR .'Controller'         => app_path('Http'. DIRECTORY_SEPARATOR .'Controllers'. DIRECTORY_SEPARATOR .'Controller.php'),
            __DIR__ . DIRECTORY_SEPARATOR . 'Controllers'. DIRECTORY_SEPARATOR .'publish'. DIRECTORY_SEPARATOR .'PasswordController' => app_path('Http'. DIRECTORY_SEPARATOR .'Controllers'. DIRECTORY_SEPARATOR .'Auth'. DIRECTORY_SEPARATOR .'PasswordController.php'),
            __DIR__ . DIRECTORY_SEPARATOR . 'Controllers'. DIRECTORY_SEPARATOR .'publish'. DIRECTORY_SEPARATOR .'FileUploadTrait'    => app_path('Http'. DIRECTORY_SEPARATOR .'Controllers'. DIRECTORY_SEPARATOR .'Traits'. DIRECTORY_SEPARATOR .'FileUploadTrait.php'),
            __DIR__ . DIRECTORY_SEPARATOR . 'Models'. DIRECTORY_SEPARATOR .'publish'. DIRECTORY_SEPARATOR .'Role'                    => app_path('Role.php'),
        ], 'laragenerators');

        // Register commands
        $this->app->bind('laragenerators:install', function ($app) {
            return new LaraGeneratorsInstall();
        });
        $this->commands([
            'laragenerators:install'
        ]);
        // Routing
        include __DIR__ . DIRECTORY_SEPARATOR .'routes.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Register main classes
        $this->app->make('Dasteem\Laragenerators\Controllers\LarageneratorsController');
        $this->app->make('Dasteem\Laragenerators\Controllers\LarageneratorsCrudController');
        $this->app->make('Dasteem\Laragenerators\Cache\QuickCache');
        $this->app->make('Dasteem\Laragenerators\Builders\MigrationBuilder');
        $this->app->make('Dasteem\Laragenerators\Builders\ModelBuilder');
        $this->app->make('Dasteem\Laragenerators\Builders\RequestBuilder');
        $this->app->make('Dasteem\Laragenerators\Builders\ControllerBuilder');
        $this->app->make('Dasteem\Laragenerators\Builders\ViewsBuilder');
        // Register dependency packages
        $this->app->register('Illuminate\Html\HtmlServiceProvider');
        // Register dependancy aliases
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('HTML', 'Illuminate\Html\HtmlFacade');
        $loader->alias('Form', 'Illuminate\Html\FormFacade');
    }

}