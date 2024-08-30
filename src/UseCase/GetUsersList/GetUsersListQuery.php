<?php

declare(strict_types=1);

namespace App\UseCase\GetUsersList;

final readonly class GetUsersListQuery
{
    public function __construct(
        public int $page = 1,
        public int $perPage = 5,
    ) {
    }
}
