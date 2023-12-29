<?php

namespace Infrastructure;



class Event
{

    private $list = [
        'UserRegistration' => [
            'SendEmail'
        ]
    ];


    public function dispatch(string $name, $model): void
    {
        foreach ($this->list[$name] as $item) {
            $class = new \ReflectionClass("\Listeners\\$item");
            $listener = $class->newInstance($model);

            $listener->handle();
        }
    }
}
