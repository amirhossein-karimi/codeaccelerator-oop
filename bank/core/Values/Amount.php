<?php

namespace Values;

use Exception;

final class Amount
{

    public function __construct(private float $value)
    {
        if ($value <= 0) {
            throw new Exception('The value must be greather than 0');
        }
        $this->value = $value;
    }

    public function getAmount(): float
    {
        return $this->value;
    }
}
