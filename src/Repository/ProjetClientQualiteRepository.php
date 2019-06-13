<?php

namespace App\Repository;

use App\Entity\ProjetClientQualite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProjetClientQualite|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjetClientQualite|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjetClientQualite[]    findAll()
 * @method ProjetClientQualite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetClientQualiteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProjetClientQualite::class);
    }

    // /**
    //  * @return ProjetClientQualite[] Returns an array of ProjetClientQualite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProjetClientQualite
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
