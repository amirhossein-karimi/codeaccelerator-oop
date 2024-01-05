<?php


use Enums\UserStatus;
use Infra\CustomDate;
use Infra\Event;
use Models\User;
use Repositories\UserRepository;
use Services\UserSerivce;
use Values\Amount;

require_once 'autoload.php';

$user = new User(
    name: 'amir',
    family: 'karimi',
    status: UserStatus::ACTIVE,
    transactions: []
);

$userService = new UserSerivce(new UserRepository(), new Event());

var_dump($userService->getListOfTransactions(20));
