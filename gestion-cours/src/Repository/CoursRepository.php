<?php
namespace App\Repository;

use App\Entity\Cours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cours>
 */
class CoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cours::class);
    }

    /**
     * Recherche les cours par niveau.
     *
     * @param string $niveau
     * @return Cours[]
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
