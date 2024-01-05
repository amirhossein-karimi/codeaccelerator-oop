<?php

namespace Values;

final class Amount
{
    public function __construct(private float $value)
    {
        if ($value <= 0) {
            throw new \InvalidArgumentException('The value should be greather than 0');
        }

        $this->value = $value;
    }

    public function getAmount(): float
    {
        return $this->value;
    }
}
