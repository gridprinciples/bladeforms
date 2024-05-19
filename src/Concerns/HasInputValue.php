<?php

namespace GridPrinciples\BladeForms\Concerns;

trait HasInputValue
{
    protected function configureValue(): void
    {
        $this->value = old($this->name, $this->value);
    }
}
