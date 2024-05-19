<?php

namespace GridPrinciples\BladeForms\Concerns;

use GridPrinciples\BladeForms\Facades\BladeForms;
use Illuminate\Support\Str;

trait GeneratesAscendingIDs
{
    protected function configureID(): void
    {
        if (empty($this->id)) {
            $this->id = $this->generateID();
        }
    }

    protected function generateID(): string
    {
        $key = Str::slug($this->name ?: 'input', '_');

        return $key.'_'.BladeForms::getAscendingID($key);
    }
}
