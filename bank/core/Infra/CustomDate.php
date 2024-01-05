<?php

namespace Infra;


use DateTimeImmutable;

final class CustomDate extends DateTimeImmutable
{

    public function now(): string
    {

        return $this->format("Y-m-d H:i:s");
    }
}
