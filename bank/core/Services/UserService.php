<?php

namespace Services;

use Models\User;
use Repositories\UserRepository;

final class UserService
{

    public function __construct(private UserRepository $userRepository)
    {
    }


    public function register(User $user): void
    {
        $this->userRepository->save($user);
    }
}
