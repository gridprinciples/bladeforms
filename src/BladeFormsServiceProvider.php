<?php

namespace GridPrinciples\BladeForms;

use Illuminate\Support\ServiceProvider;

class BladeFormsServiceProvider extends ServiceProvider {

    public function boot()
    {
        // load the view files
        $this->loadViewsFrom(__DIR__ . '/views', 'form');

        // publish the view files
        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/vendor/form'),
        ]);
    }

    public function register()
    {
        // Register the HTML provider
        $this->app->register('Collective\Html\HtmlServiceProvider');

        $this->app->booting(function()
        {
            // Apply the HTML facades
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();

            $loader->alias('Form', 'Collective\Html\FormFacade');
            $loader->alias('Html', 'Collective\Html\HtmlFacade');
        });
    }
}
