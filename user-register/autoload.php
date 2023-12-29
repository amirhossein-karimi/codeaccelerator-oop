<?php

spl_autoload_register('autoload');

function autoload($className)
{
    include 'src/' . $className . '.php';
}

