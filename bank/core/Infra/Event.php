<?php

namespace Infra;


use ReflectionClass;
use Repositories\TransactionRepository;

final class Event
{


    const LISTENERS = [
        'WithDrawal' => [
            'WithDrawalHandler'
        ],
        'Deposit' => [
            'DepositHandler'
        ]
    ];


    public function dispath(string $handler, array $data): void
    {

        foreach (self::LISTENERS[$handler] as $callback) {

            $class = new ReflectionClass("\Handlers\\$callback");

            /**
             * each handler maybe need some dependency inject them here
             */
            $h = $class->newInstance($data, new TransactionRepository());
            $h->handler();
        }
    }
}
