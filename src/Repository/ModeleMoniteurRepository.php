<?php

namespace App\Repository;

use App\Entity\ModeleMoniteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ModeleMoniteur>
 *
 * @method ModeleMoniteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModeleMoniteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModeleMoniteur[]    findAll()
 * @method ModeleMoniteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModeleMoniteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModeleMoniteur::class);
    }

    public function save(ModeleMoniteur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ModeleMoniteur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ModeleMoniteur[] Returns an array of ModeleMoniteur objects
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

//    public function findOneBySomeField($value): ?ModeleMoniteur
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
