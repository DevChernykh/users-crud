<?php

declare(strict_types=1);

namespace App\Controller;

use App\Resource\UsersListResource;
use App\UseCase\GetUsersList\GetUsersListHandler;
use App\UseCase\GetUsersList\GetUsersListQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/users', methods: ['GET'])]
class GetUsersListController extends AbstractController
{
    public function __invoke(
        Request $request,
        GetUsersListHandler $getUsers
    ): JsonResponse {
        $getUsersListQuery = new GetUsersListQuery(
            (int) $request->query->get('page', 1),
            (int) $request->query->get('perPage', 5),
        );

        $users = $getUsers($getUsersListQuery);

        return new JsonResponse(new UsersListResource($users));
    }
}
