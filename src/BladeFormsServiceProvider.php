<?php

namespace GridPrinciples\BladeForms;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeFormsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/blade-forms.php' => config_path('blade-forms.php'),
        ], 'blade-forms-config');

        $this->mergeConfigFrom(
            __DIR__.'/../config/blade-forms.php', 'blade-forms'
        );

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'blade-forms');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/forms'),
        ], 'blade-forms');

        Blade::componentNamespace(
            'GridPrinciples\\BladeForms\\View\\Components', 
            config('blade-forms.view_component_namespace')
        );

        if($shortcutName = config('blade-forms.form_component_name')) {
            // Without this, the <x-form> component can still be called
            // using <x-form::form>, but this makes it easier to read.
            Blade::component(
                $shortcutName,
                \GridPrinciples\BladeForms\View\Components\Form::class
            );
        }
    }
}
