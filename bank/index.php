<?php

use Enums\UserStatus;
use Infra\Event;
use Models\User;
use Repositories\UserRepository;
use Services\UserService;
use Values\Amount;

require_once 'autoload.php';

$user = new User('amir', 'karimi', UserStatus::ACTIVE);

$userSerivce = new UserService(
    new UserRepository(),
    new Event()
);

$userSerivce->register($user, new Amount(25));
