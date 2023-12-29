<?php
namespace Values;

final class Email
{


    public function __construct(private string $email)
    {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Email is not valid');
        }

        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
