<?php

namespace GridPrinciples\BladeForms\View\Components;

use Illuminate\View\Component;
use GridPrinciples\BladeForms\Concerns;

class SelectOption extends Component
{
    use Concerns\HasLabel;
    use Concerns\HasWrapper;
    use Concerns\GeneratesAscendingIDs;

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
