<?php
require_once './vendor/autoload.php';
require_once 'EmailConfig.php';
require_once 'EmailAdapter.php';

use PHPMailer\PHPMailer\PHPMailer;

$emailConfig = new EmailConfig();
$emailConfig->setPort(456);
$emailConfig->setHost('stmp.example.com');
$emailConfig->setUsername('username');
$emailConfig->setPassword('xxxxxxxxxxx');
$emailConfig->setSMTPDebug(1);
$emailConfig->setSMPTAuth(true);
$emailConfig->setSMTPSecure('lts');


$emailAdapter = new EmailAdapter(
    new PHPMailer(true),
    $emailConfig
);

$emailAdapter->setFrom('digikala@info.com');

$emailAdapter->setFromName('Digikala');

$emailAdapter->setSubject('خوش آمدید');

$emailAdapter->setPattern('welcome', ['user_name' => 'مصطفی مرادی']);

$emailAdapter->send();
