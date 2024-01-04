<?php

use Enums\UserStatus;
use Models\User;
use Repositories\UserRepository;
use Services\UserService;

require_once 'autoload.php';

$user = new User('amir', 'karimi', UserStatus::ACTIVE);

$userSerivce = new UserService(new UserRepository());
$userSerivce->register($user);
