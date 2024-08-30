<?php

declare(strict_types=1);

namespace App\UseCase\DeleteUser;

use App\Entity\User;
use App\Exception\UserNotFoundException;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

final readonly class DeleteUserHandler
{
    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @throws UserNotFoundException
     */
    public function __invoke(DeleteUserCommand $command): void
    {
        $user = $this->findUserById($command->userId);
        $user->setDeletedAt(new DateTimeImmutable());

        $this->entityManager->flush();
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
