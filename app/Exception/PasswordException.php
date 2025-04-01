<?php

namespace App\Exception;

class PasswordException  extends  \Exception
{
    /**
     * Create a new class instance.
     */
    public function __construct( $message)
    {
        parent::__construct($message);
    }
}
