<?php

namespace GridPrinciples\BladeForms\Concerns;

trait HasInputValue
{
    protected $fillValue = true;

    protected function configureValue(): void
    {
        if (count(old() ?? [])) {
            if ($this->fillValue) {
                $this->value = old($this->name);
            }
        }
    }
}
