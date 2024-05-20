<?php

namespace GridPrinciples\BladeForms\View\Components;

use GridPrinciples\BladeForms\Concerns;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\ComponentSlot;

abstract class ControlComponent extends Component
{
    use Concerns\CanHaveOptions;
    use Concerns\GeneratesAscendingIDs;
    use Concerns\HasHelpText;
    use Concerns\HasInputGroup;
    use Concerns\HasInputValue;
    use Concerns\HasLabel;
    use Concerns\HasWrapper;

    public function __construct(
        public ?string $name = null,
        public ?string $id = null,
        public mixed $value = null,
        public ?string $error = null,
        public ?bool $required = false,
        public string|Htmlable|null|ComponentSlot $label = null,
        public string|Htmlable|null|ComponentSlot $help = null,
        public ?ComponentSlot $wrapper = null,
        public ?ComponentSlot $inputGroup = null,
        public array|ComponentAttributeBag $wrapperAttributes = [],
        public array|ComponentAttributeBag $inputGroupAttributes = [],
        public array|ComponentAttributeBag $labelAttributes = [],
        public array|Collection|Arrayable $options = [],
        public bool $multiple = false,
        public bool $checked = false,
        public bool $standalone = true,
    ) {
        $this->configureID();
        $this->configureWrapper();
        $this->configureLabel();
        $this->configureInputGroup();
        $this->configureHelpText();
        $this->configureOptions();
        $this->configureValue();
    }
}
