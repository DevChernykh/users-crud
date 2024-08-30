<?php

declare(strict_types=1);

namespace App\Resource;

use App\UseCase\UpdateUser\UpdateUserResult;
use JsonSerializable;

final readonly class UpdatedUserResource implements JsonSerializable
{
    public function __construct(
        private UpdateUserResult $result,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->result->userId,
            'surname' => $this->result->surname,
            'name' => $this->result->name,
            'email' => $this->result->email,
            'updated_at' => $this->result->updatedAt,
        ];
    }
}
