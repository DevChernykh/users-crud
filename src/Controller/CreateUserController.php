<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\CreateUserRequest;
use App\Resource\CreatedUserResource;
use App\UseCase\CreateUser\CreateUserCommand;
use App\UseCase\CreateUser\CreateUserHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/users', methods: ['POST'])]
class CreateUserController extends AbstractController
{
    public function __invoke(
        #[MapRequestPayload] CreateUserRequest $createUserRequest,
        CreateUserHandler $createUser,
    ): JsonResponse {
        $createUserCommand = new CreateUserCommand(
            $createUserRequest->surname,
            $createUserRequest->name,
            $createUserRequest->email,
        );

        $result = $createUser($createUserCommand);

        return new JsonResponse(new CreatedUserResource($result));
    }
}
