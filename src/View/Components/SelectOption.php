<?php

namespace GridPrinciples\BladeForms\View\Components;

use GridPrinciples\BladeForms\Concerns;
use Illuminate\View\Component;

class SelectOption extends Component
{
    use Concerns\GeneratesAscendingIDs;
    use Concerns\HasLabel;
    use Concerns\HasWrapper;

    public function __construct(
        public ?string $name = null,
        public ?string $id = null,
        public ?string $value = null,
        public ?string $label = null,
        public bool $selected = false,
    ) {
        $this->configureID();
        $this->configureWrapper();
        $this->configureLabel();
    }

    public function render()
    {
        return view('blade-forms::select-option');
    }
}
