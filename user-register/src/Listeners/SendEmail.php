<?php

namespace Listeners;

use Models\User;

class SendEmail
{

    public function __construct(private User $user)
    {
    }

    public function handle(): void
    {

        echo "An email was sent to : {$this->user->getEmail()}";
    }
}
