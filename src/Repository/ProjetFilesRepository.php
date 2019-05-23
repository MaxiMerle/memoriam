<?php

namespace App\Repository;

use App\Entity\ProjetFiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProjetFiles|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjetFiles|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjetFiles[]    findAll()
 * @method ProjetFiles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetFilesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProjetFiles::class);
    }

    // /**
    //  * @return ProjetFiles[] Returns an array of ProjetFiles objects
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
    public function findOneBySomeField($value): ?ProjetFiles
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
