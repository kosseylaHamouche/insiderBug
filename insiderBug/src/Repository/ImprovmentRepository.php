<?php

namespace App\Repository;

use App\Entity\Improvment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Improvment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Improvment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Improvment[]    findAll()
 * @method Improvment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImprovmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Improvment::class);
    }

    // /**
    //  * @return Improvment[] Returns an array of Improvment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Improvment
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
