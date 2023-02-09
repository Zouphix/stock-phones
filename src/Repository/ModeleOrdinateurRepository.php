<?php

namespace App\Repository;

use App\Entity\ModeleOrdinateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ModeleOrdinateur>
 *
 * @method ModeleOrdinateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModeleOrdinateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModeleOrdinateur[]    findAll()
 * @method ModeleOrdinateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModeleOrdinateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModeleOrdinateur::class);
    }

    public function save(ModeleOrdinateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ModeleOrdinateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ModeleOrdinateur[] Returns an array of ModeleOrdinateur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ModeleOrdinateur
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
