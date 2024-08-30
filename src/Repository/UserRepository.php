<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findByEmail(string $email): ?User
    {
        $builder = $this->createQueryBuilder('u')
            ->where('u.email = :email')
            ->setParameter('email', $email);

        $query = $builder->getQuery()
            ->setMaxResults(1);

        return $query->getOneOrNullResult();
    }
}
