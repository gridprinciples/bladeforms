<?php

namespace GridPrinciples\BladeForms\Concerns;

use Illuminate\View\ComponentSlot;

trait HasWrapper
{
    protected function configureWrapper(): void
    {
        if (!empty($this->wrapperAttributes)) {
            // Convenience for adding attributes to the wrapper.
            $this->wrapper->attributes = $this->wrapper->attributes->merge($this->wrapperAttributes);
        }
    }
}
