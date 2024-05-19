<?php

namespace GridPrinciples\BladeForms\Concerns;

use Illuminate\View\ComponentSlot;

trait HasHelpText
{
    protected function configureHelpText(): void
    {
        if (!$this->help instanceof ComponentSlot) {
            // Turn a plaintext help into a full slot.
            $this->help = new ComponentSlot($this->help);
        }
    }
}
