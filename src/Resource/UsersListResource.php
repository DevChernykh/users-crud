<?php

declare(strict_types=1);

namespace App\Resource;

use App\UseCase\GetUsersList\GetUsersListResult;
use App\UseCase\GetUsersList\UserItem;
use JsonSerializable;

final readonly class UsersListResource implements JsonSerializable
{
    public function __construct(
        private GetUsersListResult $result,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'totalCounts' => $this->result->totalCounts,
            'users' => array_map(function (UserItem $user) {
                return [
                    'id' => $user->userId,
                    'surname' => $user->surname,
                    'name' => $user->name,
                    'email' => $user->email,
                ];
            }, $this->result->users)
        ];
    }
}
