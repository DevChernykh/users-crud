<?php

declare(strict_types=1);

namespace App\UseCase\UpdateUser;

use DateTimeImmutable;

final readonly class UpdateUserResult
{
    public function __construct(
        public int $userId,
        public string $surname,
        public string $name,
        public string $email,
        public DateTimeImmutable $updatedAt,
    ) {
    }
}
