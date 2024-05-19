<?php

namespace GridPrinciples\BladeForms\Concerns;

use Illuminate\View\ComponentSlot;

trait HasInputValue
{
    protected function configureValue(): void
    {
        $this->value = old($this->name, $this->value);
    }
}
