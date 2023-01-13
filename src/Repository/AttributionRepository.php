<?php

namespace App\Repository;

use App\Entity\Attribution;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Attribution>
 *
 * @method Attribution|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attribution|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attribution[]    findAll()
 * @method Attribution[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attribution::class);
    }

    public function save(Attribution $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Attribution $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


public function getAttributionInfo(){
    $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT e.Nom, e.civilite, e.Prenom, e.Email, t.communiquant, t.imeiCommuniquant, t.imeiAchete, l.miseService
            FROM App\Entity\Employe e
            INNER JOIN App\Entity\Attribution a WITH a.employeId = e.id
            INNER JOIN App\Entity\Ligne l WITH a.ligneId = l.id
            INNER JOIN App\Entity\Terminal t WITH a.terminalId = t.id
            INNER JOIN App\Entity\Forfait f WITH l.forfaitId = f.id
            INNER JOIN App\Entity\Liste li with l.listeId = li.id'
            
        );

        return $query->getResult();
}
}
