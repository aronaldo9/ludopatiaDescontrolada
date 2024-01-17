<?php

namespace App\Repository;

use App\Entity\Papeleta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Papeleta>
 *
 * @method Papeleta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Papeleta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Papeleta[]    findAll()
 * @method Papeleta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PapeletaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Papeleta::class);
    }

//    /**
//     * @return Papeleta[] Returns an array of Papeleta objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Papeleta
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
