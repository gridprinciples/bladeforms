<?php

namespace GridPrinciples\BladeForms;

class BladeFormsServiceProvider {

    public function boot()
    {
        // publish the view files
        $this->loadViewsFrom(__DIR__ . '/views', 'forms');
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
