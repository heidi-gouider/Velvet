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
   public function getQuantiteVendu(Disc $disc): int
   {
    $quantiteVendu = 0;
    // $qb = $this->createQueryBuilder('d');
       return (int) $this->createQueryBuilder('d')
           ->select('SUM(detail.quantity)')
        //    ->select('SUM(d.vente) as quantiteVendu')
           ->leftjoin('d.details', 'detail')
           ->where('d.id = :disc_id')
           ->setParameter('disc_id', $disc->getId())
           ->getQuery()
        //    ->getResult();
        // Cette méthode est utilisée lorsque l'on attend un seul résultat scalaire 
            ->getSingleScalarResult(); 
        // (un nombre, une chaîne, etc.) à partir de la requête
        // $result = $this->getQuery()->getSingleScalarResult();
        // $quantiteVendu = $this->getQuery()->getSingleScalarResult();

// Vérifier si $quantiteVendu est null
// if ($quantiteVendu === null) {
    // return 0; 
    // Retourner 0 si aucun résultat n'est trouvé
// }
// Convertir et retourner en entier
// return (int) $quantiteVendu; 
    // Si $quantiteVendu est null (aucun enregistrement trouvé), retourner 0
    return $quantiteVendu ?? 0;
    // Retourne 0 si $result est null
    // return (int) $result ?? 0;
   }

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
