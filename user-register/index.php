<?php


require_once 'autoload.php';

use Infrastructure\Event;
use Models\User;
use Repositories\UserRepository;
use Services\UserService;
use Values\Email;
use Values\Password;

$email = new Email('ali@gmail.com');
$password = new Password('12345678');

$user = new User(
    fullName: 'amirkarimi',
    password: $password,
    address: 'Iran-alborz',
    email: $email
);

$userRepository = new UserRepository();
$event = new Event();
$userService = new UserService($userRepository, $event);

$userService->register($user);
