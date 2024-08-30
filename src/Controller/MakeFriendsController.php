<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Friends;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/api/v1/friends/{leftId}/{rightId}', methods: ['POST'])]
class MakeFriendsController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function __invoke(int $leftId, int $rightId): JsonResponse
    {
        // Тут нужно реализовать проверку, что эти пользователи действительно существуют.
        // Так же нужно проверить, а не являются ли они уже друзьями.
        $friendsLeft = new Friends();
        $friendsLeft->setLeftId($leftId);
        $friendsLeft->setRightId($rightId);

        $friendsRight = new Friends();
        $friendsRight->setLeftId($rightId);
        $friendsRight->setRightId($leftId);

        $this->entityManager->persist($friendsLeft);
        $this->entityManager->persist($friendsRight);
        $this->entityManager->flush();

        return new JsonResponse();
    }
}
