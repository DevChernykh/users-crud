<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class UserEmailAlreadyExistException extends HttpResponsableException
{
    public function __construct(string $email)
    {
        parent::__construct('User with email "' . $email . '" already exist!');
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_CONFLICT;
    }
}
