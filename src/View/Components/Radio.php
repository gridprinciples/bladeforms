<?php

namespace GridPrinciples\BladeForms\View\Components;

use Illuminate\View\Component;
use Illuminate\View\ComponentSlot;
use GridPrinciples\BladeForms\Concerns;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\ComponentAttributeBag;

class Radio extends Component
{
    use Concerns\HasLabel;
    use Concerns\HasWrapper;
    use Concerns\GeneratesAscendingIDs;

    public function __construct(
        public ?string $name = null,
        public ?string $id = null,
        public ?string $value = null,
        public string | Htmlable | null | ComponentSlot $label = null,
        public ?ComponentSlot $wrapper = null,
        public array | ComponentAttributeBag $wrapperAttributes = [],
        public array | ComponentAttributeBag $labelAttributes = [],
    )
    {
        $this->configureID();
        $this->configureWrapper();
        $this->configureLabel();
    }

    public function render()
    {
        return view('blade-forms::radio');
    }
}
