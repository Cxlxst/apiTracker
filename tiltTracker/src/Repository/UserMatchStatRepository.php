<?php

namespace App\Repository;

use App\Entity\UserMatchStat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserMatchStat>
 *
 * @method UserMatchStat|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserMatchStat|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserMatchStat[]    findAll()
 * @method UserMatchStat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserMatchStatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserMatchStat::class);
    }

//    /**
//     * @return UserMatchStat[] Returns an array of UserMatchStat objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserMatchStat
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
