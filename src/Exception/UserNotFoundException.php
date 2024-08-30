<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;

class UserNotFoundException extends HttpResponsableException
{
    public function __construct()
    {
        parent::__construct('User not found!');
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_NOT_FOUND;
    }
}
