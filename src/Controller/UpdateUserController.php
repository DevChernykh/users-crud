<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\UpdateUserRequest;
use App\Resource\UpdatedUserResource;
use App\UseCase\UpdateUser\UpdateUserCommand;
use App\UseCase\UpdateUser\UpdateUserHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/users/{userId}', methods: ['PUT'])]
class UpdateUserController extends AbstractController
{
    public function __invoke(
        int $userId,
        #[MapRequestPayload] UpdateUserRequest $updateUserRequest,
        UpdateUserHandler $updateUser,
    ): JsonResponse {
        $updateUserCommand = new UpdateUserCommand(
            $userId,
            $updateUserRequest->surname,
            $updateUserRequest->name,
            $updateUserRequest->email,
        );

        $result = $updateUser($updateUserCommand);

        return new JsonResponse(new UpdatedUserResource($result));
    }
}
