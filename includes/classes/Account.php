<?php

class Account
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
}