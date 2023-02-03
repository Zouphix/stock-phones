<?php

namespace App\Repository;

use App\Entity\Moniteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Moniteur>
 *
 * @method Moniteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Moniteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Moniteur[]    findAll()
 * @method Moniteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoniteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Moniteur::class);
    }

    public function save(Moniteur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Moniteur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return Moniteur[] Returns an array of Moniteur objects
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

    //    public function findOneBySomeField($value): ?Moniteur
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function getMoniteurInfo()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT  m.id, m.numSerie, m.commentaire, l.libelle as lieu, mo.libelle as modele, m.isDeleted
            FROM App\Entity\Moniteur m
            INNER JOIN App\Entity\Lieu l WITH m.lieuId = l.id
            INNER JOIN App\Entity\ModeleMoniteur mo WITH m.modeleMoniteurId = mo.id'
           

        );

        return $query->getResult();
    }
}
