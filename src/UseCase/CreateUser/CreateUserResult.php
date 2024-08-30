<?php

declare(strict_types=1);

namespace App\UseCase\CreateUser;

final readonly class CreateUserResult
{
    public function __construct(
        public int $userId,
    ) {
    }
}
