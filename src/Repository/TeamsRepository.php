<?php

namespace App\Repository;

use App\Entity\Teams;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TeamsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Teams::class);
    }

    public function getTeamsWithPlayerForSale(string $currentTeamsId): mixed
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.players','p')
            ->where('count(p.upForSale = true) > 0')
            ->andWhere('t.id <> :currentTeamsId')
            ->setParameter('currentTeamsId', $currentTeamsId);
    }
}
