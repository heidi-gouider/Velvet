<?php

namespace App\Repository;

use App\Entity\Detail;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Detail>
 */
class DetailRepository extends ServiceEntityRepository
{
    private $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Detail::class);
        $this->entityManager = $entityManager;
    }

    //    /**
    //     * @return Detail[] Returns an array of Detail objects
    //     */
    public function findByTopVente(): array
    {
        $rsm = new ResultSetMapping();
// build rsm here

$query = $this->entityManager->createNativeQuery('SELECT disc_id, SUM(quantite) AS quantite_total FROM detail GROUP By disc_id
ORDER BY quantite_total DESC LIMIT 3', $rsm);
// $query->setParameter(1, 'romanb');

$result = $query->getResult();
return $result;


        //    return $this->createQueryBuilder('d')
        // $qb = $this->createQueryBuilder('detail');

        // $topDiscs = $qb
        //     ->select('disc_id, SUM(quantite) AS quantite_total')
        //        ->groupBy('d.id')
        //     ->groupBy('disc_id')
        //     ->orderBy('quantite_total', 'DESC')
        //     ->setMaxResults(3)
        //     ->getQuery()
        //    ->getResult();

        // return $topDiscs->getResult();
        // return $topDiscs;

    }

    //    public function findOneBySomeField($value): ?Detail
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
