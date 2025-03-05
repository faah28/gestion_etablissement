<?php
namespace App\Repository;

use App\Entity\EmploiTemps;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmploiTemps>
 */
class EmploiTempsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmploiTemps::class);
    }

    /**
     * Recherche l'emploi du temps d'une classe spécifique.
     *
     * @param int $classeId
     * @return EmploiTemps[]
     */
    public function findByClasse(int $classeId): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.classe = :classeId')
            ->setParameter('classeId', $classeId)
            ->orderBy('e.jour', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
