<?php

namespace App\Repository;

use App\Entity\ProjetClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProjetClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjetClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjetClient[]    findAll()
 * @method ProjetClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetClientRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProjetClient::class);
    }

    // /**
    //  * @return ProjetClient[] Returns an array of ProjetClient objects
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
    public function findOneBySomeField($value): ?ProjetClient
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
