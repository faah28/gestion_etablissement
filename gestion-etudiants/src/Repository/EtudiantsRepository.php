<?php
namespace App\Repository;

use App\Entity\Etudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Etudiant>
 */
class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }

    /**
     * Recherche les étudiants par classe.
     *
     * @param int $classeId
     * @return Etudiant[]
     */
    public function findByClasse(int $classeId): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.classe = :classeId')
            ->setParameter('classeId', $classeId)
            ->orderBy('e.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
