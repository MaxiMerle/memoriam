<?php
namespace App\Repository;
use App\Entity\ImageFiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
class ImageFilesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ImageFiles::class);
    }

    public function findOneBySomeField($id): ?ImageFiles
    {
        return $this->createQueryBuilder('p')
            ->select('p.projet')
            ->Where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
            ;
    }
}