<?php

namespace Models;

use Infrastructure\Model;
use Values\Email;
use Values\Password;

final class User implements Model
{

    public function __construct(
        private string $fullName,
        private Password $password,
        private string $address,
        private Email $email
    ) {
    }
    public function getFullName(): string
    {
        return $this->fullName;
    }
    public function getPassword(): string
    {

        return $this->password->getPassword();
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getEmail(): string
    {
        return $this->email->getEmail();
    }

}
