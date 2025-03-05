<?php
namespace App\Repository;

use App\Entity\Classe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Classe>
 */
class ClasseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Classe::class);
    }

    /**
     * Recherche une classe par niveau.
     *
     * @param string $niveau
     * @return Classe[]
     */
    public function findByNiveau(string $niveau): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.niveau = :niveau')
            ->setParameter('niveau', $niveau)
            ->orderBy('c.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
