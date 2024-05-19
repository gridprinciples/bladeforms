<?php

namespace GridPrinciples\BladeForms\Concerns;

trait CanHaveOptions
{
    protected $optionsEnabled = false;

    protected function configureOptions(): void
    {
        if($this->optionsAreEnabled()) {
            $this->options = collect($this->options);
        }
    }

    public function optionsAreEnabled(): bool
    {
        return $this->optionsEnabled;
    }
}