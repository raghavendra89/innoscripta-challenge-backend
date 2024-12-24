<?php

namespace App\Exceptions;

use Exception;

class UserPreferencesNotSetException extends Exception
{
    public function __construct()
    {
        $message = 'User has not set any news preferences.';
        parent::__construct($message);
    }
}
