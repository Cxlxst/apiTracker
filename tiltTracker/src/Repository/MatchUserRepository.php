<?php

namespace App\Repository;

use App\Entity\MatchUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MatchUser>
 *
 * @method MatchUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method MatchUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method MatchUser[]    findAll()
 * @method MatchUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatchUser::class);
    }

//    /**
//     * @return MatchUser[] Returns an array of MatchUser objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MatchUser
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}