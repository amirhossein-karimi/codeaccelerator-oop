<?php


spl_autoload_register('autoload');

function autoload($className)
{
    include 'core/' . $className . '.php';
}
