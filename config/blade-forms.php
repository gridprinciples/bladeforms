<?php

// config for GridPrinciples/BladeForms
return [
    /**
     * The namespace for loaded Blade components.
     * 
     * If you're already using the `form` namespace, i.e. `<x-form::input />`,
     * you can change the package namespace to avoid collisions.
     */
    'view_component_namespace' => 'form',

    /**
     * The name of the Blade component to use for form elements.
     * 
     * If you're already using <x-form />, you can change it here.
     * This is unrelated to the namespace above.
     */
    'form_component_name' => 'form',

    /**
     * How many (if any) zeros to pad ascending identifiers with.
     * The resulting ID will look something like `08`, `09`, `10`, etc.
     */
    'zerofill_ids' => 2,
];
