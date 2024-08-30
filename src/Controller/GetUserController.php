<?php

declare(strict_types=1);

namespace App\Controller;

use App\Resource\UserDataResource;
use App\UseCase\GetUser\GetUserHandler;
use App\UseCase\GetUser\GetUserQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/users/{userId}', methods: ['GET'])]
class GetUserController extends AbstractController
{
    public function __invoke(
        int $userId,
        GetUserHandler $getUser,
    ): JsonResponse {
        $getUserQuery = new GetUserQuery($userId);
        $user = $getUser($getUserQuery);

        return new JsonResponse(new UserDataResource($user));
    }
}
