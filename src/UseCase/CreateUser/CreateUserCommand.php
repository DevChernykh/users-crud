<?php

declare(strict_types=1);

namespace App\UseCase\CreateUser;

final readonly class CreateUserCommand
{
    public function __construct(
        public string $surname,
        public string $name,
        public string $email,
    ) {
    }
}
