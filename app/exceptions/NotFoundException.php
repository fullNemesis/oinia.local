<?php

namespace oinia\app\exceptions;

use Exception;

class NotFoundException extends AppException
{
    public function __construct(string $message = "", int $code = 404)
    {
        parent::__construct($message, $code);
    }
}
