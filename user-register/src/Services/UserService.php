<?php

namespace Services;

use Exception;
use Infrastructure\Event;
use Models\User;
use Repositories\UserRepository;

final class UserService
{


    public function __construct(
        private UserRepository $userRepository,
        private Event $event
    ) {
    }

    public function register(User $user)
    {

        if ($this->userRepository->find('email', $user->getEmail())) {
            throw new Exception('Email already exists');
        }

        $this->userRepository->save($user);

        $this->event->dispatch(
            name: 'UserRegistration',
            model: $user
        );
    }
}
