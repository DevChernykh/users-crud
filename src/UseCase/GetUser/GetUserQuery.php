<?php

declare(strict_types=1);

namespace App\UseCase\GetUser;

final readonly class GetUserQuery
{
    public function __construct(
        public int $userId,
    ) {
    }
}
