<?php

namespace GridPrinciples\BladeForms\View\Components;

class Checkbox extends ControlComponent
{
    protected $fillValue = false;

    public function render()
    {
        return view('blade-forms::checkbox');
    }
}
