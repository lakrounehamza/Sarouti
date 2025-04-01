<?php

namespace App\Exception;

class mailRegisterException extends \Exception
{
    /**
     * Create a new class instance.
     */
    public function __construct($message = "Email already exists")
    {
        parent::__construct($message);
    }
}
