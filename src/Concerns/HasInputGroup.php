<?php

namespace GridPrinciples\BladeForms\Concerns;

trait HasInputGroup
{
    protected function configureInputGroup(): void
    {
        if (! empty($this->inputGroupAttributes)) {
            // Convenience for adding attributes to the group.
            $this->inputGroup->attributes = $this->inputGroup->attributes->merge($this->inputGroupAttributes);
        }
    }
}
