<?php

namespace Models;

use Enums\UserStatus;

final class User
{

    public function __construct(private string $name, private string $family, private UserStatus $userStatus)
    {
    }

    public function getName(): string
    {

        return $this->name;
    }

    public function getFamily(): string
    {
        return $this->family;
    }

    public function getStatus(): int
    {
        return $this->userStatus->value;
    }
}
