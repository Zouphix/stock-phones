<?php

namespace App\Repository;

use App\Entity\Ordinateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ordinateur>
 *
 * @method Ordinateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ordinateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ordinateur[]    findAll()
 * @method Ordinateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdinateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ordinateur::class);
    }

    public function save(Ordinateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Ordinateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Ordinateur[] Returns an array of Ordinateur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ordinateur
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function getOrdinateurInfo(){
    $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT o.id, o.numSerie, o.expirationGarantie, o.ip, o.domaine, o.commentaire, e.civilite, e.Nom, e.Prenom, e.Email, mo.libelle as modele, l.libelle as lieu,
            s.libelle as statut, t.libelle as type, o.isDeleted
            FROM App\Entity\Ordinateur o
            INNER JOIN App\Entity\Employe e WITH o.employeId = e.id
            INNER JOIN App\Entity\ModeleOrdinateur mo WITH o.modeleOrdinateurId = mo.id
            INNER JOIN App\Entity\Lieu l WITH o.lieuId = l.id
            INNER JOIN App\Entity\Statut s WITH o.statutId = s.id
            INNER JOIN App\Entity\Type t with o.typeId = t.id'
            
        );

        return $query->getResult();
}
}
