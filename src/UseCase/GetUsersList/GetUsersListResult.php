<?php

declare(strict_types=1);

namespace App\UseCase\GetUsersList;

final readonly class GetUsersListResult
{
    /**
     * @param array<UserItem> $users
     */
    public function __construct(
        public int $totalCounts,
        public array $users
    ) {
    }
}
