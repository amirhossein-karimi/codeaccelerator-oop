<?php

spl_autoload_register('autoload');


function autoload($class): void
{
    include_once 'core/' . $class . '.php';
}
