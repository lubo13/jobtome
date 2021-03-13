<?php

namespace App\Repository;

use App\Entity\Redirection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Redirection|null find($id, $lockMode = null, $lockVersion = null)
 * @method Redirection|null findOneBy(array $criteria, array $orderBy = null)
 * @method Redirection[]    findAll()
 * @method Redirection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RedirectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Redirection::class);
    }

    public function save(Redirection $redirection): void
    {
        $this->_em->persist($redirection);
        $this->_em->flush();
    }

    public function findOneByUrlOrigin(string $urlOrigin): ?Redirection
    {
        return $this->createQueryBuilder('r')
            ->join('r.url', 'u')
            ->where('u.origin = :origin')
            ->setParameter('origin', $urlOrigin)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
