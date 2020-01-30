<?php

namespace App\Repository;

use App\Entity\PricesDay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PricesDay|null find($id, $lockMode = null, $lockVersion = null)
 * @method PricesDay|null findOneBy(array $criteria, array $orderBy = null)
 * @method PricesDay[]    findAll()
 * @method PricesDay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PricesDayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PricesDay::class);
    }

    // /**
    //  * @return PricesDay[] Returns an array of PricesDay objects
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
    public function findOneBySomeField($value): ?PricesDay
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
