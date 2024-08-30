<?php

declare(strict_types=1);

namespace App\Resource;

use App\UseCase\GetUser\GetUserResult;
use JsonSerializable;

final readonly class UserDataResource implements JsonSerializable
{
    public function __construct(
        private GetUserResult $result,
    ) {
    }


    public function jsonSerialize(): array
    {
        return [
            'id' => $this->result->userId,
            'surname' => $this->result->surname,
            'name' => $this->result->name,
            'email' => $this->result->email,
        ];
    }
}
