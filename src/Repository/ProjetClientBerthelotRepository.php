<?php

namespace App\Repository;

use App\Entity\ProjetClientBerthelot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProjetClientBerthelot|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjetClientBerthelot|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjetClientBerthelot[]    findAll()
 * @method ProjetClientBerthelot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetClientBerthelotRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProjetClientBerthelot::class);
    }

    // /**
    //  * @return ProjetClientBerthelot[] Returns an array of ProjetClientBerthelot objects
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
    public function findOneBySomeField($value): ?ProjetClientBerthelot
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
