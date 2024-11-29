<?php

namespace oinia\app\exceptions;

use Exception;

class AuthenticationException extends AppException
{
    public function __construct(string $message = "", int $code = 403)
    {
        parent::__construct($message, $code);
    }
}
