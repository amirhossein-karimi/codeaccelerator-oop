<?php

namespace Values;

final class Password
{


    public function __construct(private string $password)
    {

        if (strlen($password) < 8) {
            throw new \InvalidArgumentException('password should be greater than 8');
        }

        $this->password = hash('sha256', $password);
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
