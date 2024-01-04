<?php

namespace Infra;

use DateTime;
use ReflectionClass;
use Repositories\TransactionRepository;
use Services\TransactionService;

final class Event
{


    const LISTENERS = [
        'UserRegister' => [
            'TransactionHandler'
        ]
    ];


    public function dispath(string $handler, array $data): void
    {

        foreach (self::LISTENERS[$handler] as $callback) {

            $class = new ReflectionClass("\Handlers\\$callback");

            /**
             * each handler maybe need some dependency inject them here
             */
            $h = $class->newInstance($data, new TransactionService(new TransactionRepository()) , new CustomDate(new DateTime()));
            $h->handler();
        }
    }
}
