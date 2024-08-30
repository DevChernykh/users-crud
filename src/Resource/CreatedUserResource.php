<?php

declare(strict_types=1);

namespace App\Resource;

use App\UseCase\CreateUser\CreateUserResult;
use JsonSerializable;

final readonly class CreatedUserResource implements JsonSerializable
{
    public function __construct(
        private CreateUserResult $result,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->result->userId,
        ];
    }
}
