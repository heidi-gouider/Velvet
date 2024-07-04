<?php

namespace App\Repository;

use App\Entity\Disc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Disc>
 */
class DiscRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Disc::class);
    }

//    /**
//     * @return Disc[] Returns an array of Disc objects
//     */
//    public function findTopDiscsVendu(int $limit): array
//    public function findBySales()

//    {
//        return $this->createQueryBuilder('d')
//            ->select('d', 'SUM(dt.quantite) AS HIDDEN sales')
//            ->leftjoin('d.details', 'dt')
//            ->groupBy('d.id')
        //    ->orderBy('d.sales', 'DESC')
//            ->setMaxResults(2)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Disc
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
