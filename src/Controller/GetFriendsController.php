<?php

declare(strict_types=1);

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/users/{userId}/friends', methods: ['GET'])]
class GetFriendsController extends AbstractController
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
                SELECT "user".* FROM "user"
                LEFT JOIN "friends" ON "user".id = "friends".right_id
                WHERE "friends".left_id = :user_id
                AND "user".deleted_at IS NULL;
            SQL)
            ->executeQuery([
                'user_id' => $userId,
            ]);

        return new JsonResponse($builder->fetchAllAssociative());
    }
}
