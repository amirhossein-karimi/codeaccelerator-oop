<?php

namespace Infra;

use DateTime;

final class CustomDate
{

    public function __construct(private DateTime $date)
    {
    }

    public function now(): string
    {
        return $this->date->format('Y-m-d h:i:s');
    }
}
