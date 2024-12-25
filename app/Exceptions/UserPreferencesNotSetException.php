<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UserPreferencesNotSetException extends HttpException
{
    public function __construct()
    {
        $message = 'User has not set any news preferences.';
        parent::__construct(422, $message);
    }
}
