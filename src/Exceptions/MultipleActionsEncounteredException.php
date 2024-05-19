<?php

namespace GridPrinciples\BladeForms\Exceptions;

use Exception;

class MultipleActionsEncounteredException extends Exception
{
    public function __construct()
    {
        parent::__construct('You cannot use both the action attribute and a shortcut method attribute.');
    }
}
