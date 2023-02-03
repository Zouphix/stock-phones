<?php

namespace App\Repository;

use App\Entity\Imprimante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Imprimante>
 *
 * @method Imprimante|null find($id, $lockMode = null, $lockVersion = null)
 * @method Imprimante|null findOneBy(array $criteria, array $orderBy = null)
 * @method Imprimante[]    findAll()
 * @method Imprimante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImprimanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Imprimante::class);
    }

    public function save(Imprimante $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Imprimante $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Imprimante[] Returns an array of Imprimante objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Imprimante
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function getImprimanteInfo()
{
    $entityManager = $this->getEntityManager();

    $query = $entityManager->createQuery(
        'SELECT  i.id, m.libelle as modele, l.libelle as lieu, i.isDeleted, i.numSerie
        FROM App\Entity\Imprimante i
        INNER JOIN App\Entity\Lieu l WITH i.lieuId = l.id
        INNER JOIN App\Entity\ModeleImprimante m WITH i.modeleImprimanteId = m.id'
       

    );

    return $query->getResult();
}
}
