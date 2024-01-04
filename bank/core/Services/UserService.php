<?php

namespace Services;

use Infra\Event;
use Models\User;
use Repositories\UserRepository;
use Values\Amount;

final class UserService
{

    public function __construct(
        private UserRepository $userRepository,
        private Event $event
    ) {
    }


    public function register(User $user, Amount $initialBalance): void
    {
        $id = $this->userRepository->save($user);

        $this->event->dispath('UserRegister', ['userID' => $id, 'amount' => $initialBalance]);
    }
}
