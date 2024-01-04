<?php

namespace Infra;

use mysqli;

abstract class Repository
{

    protected $conn;

    public function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', 'root', 'bank');
    }
}
