<?php

namespace App\Auth\Exceptions;

use RuntimeException;

class FailedLoginException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct(__('auth.error'), 401);
    }
}
