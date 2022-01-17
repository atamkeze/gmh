<?php

namespace App\Repository;

use App\Entity\UserGallery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserGallery|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserGallery|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserGallery[]    findAll()
 * @method UserGallery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserGalleryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserGallery::class);
    }

    // /**
    //  * @return UserGallery[] Returns an array of UserGallery objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserGallery
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
