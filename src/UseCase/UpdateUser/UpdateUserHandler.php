<?php

declare(strict_types=1);

namespace App\UseCase\UpdateUser;

use App\Entity\User;
use App\Exception\UserEmailAlreadyExistException;
use App\Exception\UserNotFoundException;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

final readonly class UpdateUserHandler
{
    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @throws UserNotFoundException|UserEmailAlreadyExistException
     */
    public function __invoke(UpdateUserCommand $command): UpdateUserResult
    {
        $user = $this->findUserId($command->userId);
        $this->checkNeedAndCanUpdateEmail($user, $command);

        $this->updateUserDataByCommand($user, $command);

        $this->entityManager->flush();

        return new UpdateUserResult(
            $user->getId(),
            $user->getSurname(),
            $user->getName(),
            $user->getEmail(),
            $user->getUpdatedAt(),
        );
    }

    /**
     * @throws UserNotFoundException
     */
    private function findUserId(int $userId): User
    {
        $user = $this->userRepository->find($userId);

        if ($user === null || $user->getDeletedAt() !== null) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    /**
     * @throws UserEmailAlreadyExistException
     */
    private function checkNeedAndCanUpdateEmail(User $user, UpdateUserCommand $command): void
    {
        if ($command->email === null) {
            return;
        }

        $findedUser = $this->userRepository->findByEmail($command->email);

        if ($findedUser !== null && $findedUser->getId() !== $user->getId()) {
            throw new UserEmailAlreadyExistException($command->email);
        }
    }

    private function updateUserDataByCommand(User $user, UpdateUserCommand $command): void
    {
        $user->setSurname($command->surname);
        $user->setName($command->name);
        $user->setEmail($command->email);
    }
}
