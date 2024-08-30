<?php

declare(strict_types=1);

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/users/{userId}/friends-of-friends', methods: ['GET'])]
class GetFriendsOfFriendsController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function __invoke(int $userId): JsonResponse
    {
        // Нужно проверить, а есть ли такой пользователь
        // И также добавить пагинацию

        $builder = $this->entityManager->getConnection()->prepare(
            <<<'SQL'
                SELECT "user".*
                FROM "user"
                    INNER JOIN "friends" fof ON "user".id = fof.right_id
                    INNER JOIN "friends" f ON fof.left_id = f.right_id
                WHERE f.left_id = :user_id
                    AND fof.right_id NOT IN (SELECT "friends".right_id FROM "friends" WHERE "friends".left_id = :user_id)
                    AND "user".id != :user_id;
            SQL)
            ->executeQuery([
                'user_id' => $userId,
            ]);

        return new JsonResponse($builder->fetchAllAssociative());
    }
}
