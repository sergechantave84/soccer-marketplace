<?php

namespace App\Repository;

use App\Entity\Teams;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class TeamsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Teams::class);
    }

    /**
     * @param string $owner
     *
     * @return QueryBuilder
     */
    public function getTeamsWithPlayerForSale(string $owner): QueryBuilder
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.players','p', Join::WITH, 'p.upForSale = true')
            ->where('t.owner <> :owner')
            ->setParameter('owner', $owner);
    }
}
