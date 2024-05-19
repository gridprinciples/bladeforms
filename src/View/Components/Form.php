<?php

namespace GridPrinciples\BladeForms\View\Components;

use GridPrinciples\BladeForms\Exceptions\MultipleActionsEncounteredException;
use Illuminate\View\Component;

class Form extends Component
{
    public function __construct(
        public ?string $action = null,
        public ?string $get = null,
        public ?string $post = null,
        public ?string $put = null,
        public ?string $patch = null,
        public ?string $delete = null,
        public string $method = 'POST',
        public bool $multipart = false,
        public bool $csrf = true,
    ) {
        if (! $action) {
            if ($get) {
                $this->action = $get;
                $this->method = 'GET';
            } elseif ($post) {
                $this->action = $post;
                $this->method = 'POST';
            } elseif ($put) {
                $this->action = $put;
                $this->method = 'PUT';
            } elseif ($patch) {
                $this->action = $patch;
                $this->method = 'PATCH';
            } elseif ($delete) {
                $this->action = $delete;
                $this->method = 'DELETE';
            }
        } elseif ($get || $post || $patch || $delete) {
            throw new MultipleActionsEncounteredException;
        }
    }

    public function render()
    {
        return view('blade-forms::form');
    }
}
