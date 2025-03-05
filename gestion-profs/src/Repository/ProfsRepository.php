<?php
namespace App\Repository;

use App\Entity\Prof;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Prof>
 */
class ProfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prof::class);
    }

    /**
     * Recherche des professeurs par spécialité.
     *
     * @param string $specialite
     * @return Prof[]
     */
    public function findBySpecialite(string $specialite): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.specialite = :specialite')
            ->setParameter('specialite', $specialite)
            ->orderBy('p.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Trouver un professeur par email.
     *
     * @param string $email
     * @return Prof|null
     */
    public function findOneByEmail(string $email): ?Prof
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
