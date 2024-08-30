<?php

declare(strict_types=1);

namespace App\UseCase\GetUser;

use App\Entity\User;
use App\Exception\UserNotFoundException;
use App\Repository\UserRepository;

final readonly class GetUserHandler
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    /**
     * @throws UserNotFoundException
     */
    public function __invoke(GetUserQuery $query): GetUserResult
    {
        $user = $this->findUserById($query->userId);

        return new GetUserResult(
            $user->getId(),
            $user->getSurname(),
            $user->getName(),
            $user->getEmail()
        );
    }

    /**
     * @throws UserNotFoundException
     */
    private function findUserById(int $userId): User
    {
        $user = $this->userRepository->find($userId);

        if ($user === null || $user->getDeletedAt() !== null) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
