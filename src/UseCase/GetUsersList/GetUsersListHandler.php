<?php

declare(strict_types=1);

namespace App\UseCase\GetUsersList;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

final readonly class GetUsersListHandler
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function __invoke(GetUsersListQuery $query): GetUsersListResult
    {
        [$totalCounts, $users] = $this->getUsersWithPaginate($query->page, $query->perPage);

        return $this->collectResult($totalCounts, $users);
    }

    private function getUsersWithPaginate(int $page, int $perPage): array
    {
        $query = $this->userRepository->createQueryBuilder('u')
            ->orderBy('u.id', 'desc')
            ->getQuery();

        $paginator = new Paginator($query);

        $totalCounts = count($paginator);

        $result = $paginator->getQuery()
            ->setFirstResult(($page - 1) * $perPage)
            ->setMaxResults($perPage)
            ->execute();

        return [$totalCounts, $result];
    }

    private function collectResult(int $totalCounts, array $users): GetUsersListResult
    {
        $data = [];

        foreach ($users as $user) {
            $data[] = new UserItem(
                $user->getId(),
                $user->getSurname(),
                $user->getName(),
                $user->getEmail()
            );
        }

        return new GetUsersListResult(
            $totalCounts,
            $data
        );
    }
}
