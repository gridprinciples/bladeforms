<?php

namespace GridPrinciples\BladeForms\Concerns;

use Illuminate\View\ComponentSlot;

trait HasLabel
{
    protected function configureLabel(): void
    {
        if (!$this->label instanceof ComponentSlot) {
            // Turn a plaintext label into a full slot.
            $this->label = new ComponentSlot($this->label);
        }

        if (!empty($this->labelAttributes)) {
            // Convenience for adding attributes to the label.
            $this->label->attributes = $this->label->attributes->merge($this->labelAttributes);
        }
    }
}