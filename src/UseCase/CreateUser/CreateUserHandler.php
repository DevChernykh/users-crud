<?php

declare(strict_types=1);

namespace App\UseCase\CreateUser;

use App\Entity\User;
use App\Exception\UserEmailAlreadyExistException;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

final readonly class CreateUserHandler
{
    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @throws UserEmailAlreadyExistException
     */
    public function __invoke(CreateUserCommand $command): CreateUserResult
    {
        $this->checkUserEmailExist($command->email);
        $user = $this->collectUserByCommand($command);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new CreateUserResult($user->getId());
    }

    /**
     * @throws UserEmailAlreadyExistException
     */
    private function checkUserEmailExist(string $email): void
    {
        if (null !== $this->userRepository->findByEmail($email)) {
            throw new UserEmailAlreadyExistException($email);
        }
    }

    private function collectUserByCommand(CreateUserCommand $command): User
    {
        return (new User())
            ->setSurname($command->surname)
            ->setName($command->name)
            ->setEmail($command->email);
    }
}
