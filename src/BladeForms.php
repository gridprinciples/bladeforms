<?php

namespace GridPrinciples\BladeForms;

class BladeForms
{
    protected array $ascendingIDs = [];

    /**
     * Get the next ascending identifier for a given key.
     * We use this to avoid ID collisions in the DOM.
     * 
     * Uses $ascendingIdentifierZerofill to determine how many zeroes to pad the ID with.
     * 
     * BladeForms::getAscendingID('foo') will return '01', '02', '03', etc.
     * 
     * @param string $key 
     * @return string 
     */
    public function getAscendingID(string $key): string
    {
        if (!isset($this->ascendingIDs[$key])) {
            $this->ascendingIDs[$key] = 0;
        }

        return str_pad((string) ++$this->ascendingIDs[$key], $this->getAscendingIdentifierZerofill(), '0', STR_PAD_LEFT);
    }

    private function getAscendingIdentifierZerofill(): int
    {
        return config('blade-forms.zerofill_ids', 2);
    }
}
