<?php

namespace App\Repository;

use App\Entity\ProjetClientCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProjetClientCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjetClientCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjetClientCategorie[]    findAll()
 * @method ProjetClientCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetClientCategorieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProjetClientCategorie::class);
    }

    // /**
    //  * @return ProjetClientCategorie[] Returns an array of ProjetClientCategorie objects
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
    public function findOneBySomeField($value): ?ProjetClientCategorie
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
