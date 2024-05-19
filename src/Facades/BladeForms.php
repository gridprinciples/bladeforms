<?php

namespace GridPrinciples\BladeForms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \GridPrinciples\BladeForms\BladeForms
 */
class BladeForms extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \GridPrinciples\BladeForms\BladeForms::class;
    }
}
