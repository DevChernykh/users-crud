<?php

declare(strict_types=1);

namespace App\Controller;

use App\UseCase\DeleteUser\DeleteUserCommand;
use App\UseCase\DeleteUser\DeleteUserHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/users/{userId}', methods: ['DELETE'])]
class DeleteUserController extends AbstractController
{
    public function __invoke(
        int $userId,
        DeleteUserHandler $deleteUser,
    ): JsonResponse {
        $deleteUserCommand = new DeleteUserCommand($userId);

        $deleteUser($deleteUserCommand);

        return new JsonResponse();
    }
}
