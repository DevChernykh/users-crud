<?php

declare(strict_types=1);

namespace App\UseCase\GetUser;

final readonly class GetUserResult
{
    public function __construct(
        public int $userId,
        public string $surname,
        public string $name,
        public string $email
    ) {
    }
}
