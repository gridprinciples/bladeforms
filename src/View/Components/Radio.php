<?php

namespace GridPrinciples\BladeForms\View\Components;

use GridPrinciples\BladeForms\Concerns;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\ComponentSlot;

class Radio extends Component
{
    use Concerns\GeneratesAscendingIDs;
    use Concerns\HasLabel;
    use Concerns\HasWrapper;

    public function __construct(
        public ?string $name = null,
        public ?string $id = null,
        public ?string $value = null,
        public string|Htmlable|null|ComponentSlot $label = null,
        public ?ComponentSlot $wrapper = null,
        public array|ComponentAttributeBag $wrapperAttributes = [],
        public array|ComponentAttributeBag $labelAttributes = [],
    ) {
        $this->configureID();
        $this->configureWrapper();
        $this->configureLabel();
    }

    public function render()
    {
        return view('blade-forms::radio');
    }
}
