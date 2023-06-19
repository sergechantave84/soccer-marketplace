<?php

namespace App\Repository;

use App\Entity\Players;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PlayersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Players::class);
    }

    public function getPlayersForSale(string $currentTeamsEmail): mixed
    {
        return $this->createQueryBuilder('p')
                    ->innerJoin('p.team','t')
                    ->where('t.owner = :currentTeamsEmail')
                    ->andWhere('p.upForSale = true')
                    ->setParameter('currentTeamsEmail', $currentTeamsEmail)
                    ->getQuery()
                    ->getResult();
    }

    public function getPlayersAvailable(string $currentTeamsEmail): mixed
    {
        return $this->createQueryBuilder('p')
                    ->innerJoin('p.team','t')
                    ->where('t.owner = :currentTeamsEmail')
                    ->andWhere('p.upForSale = false')
                    ->setParameter('currentTeamsEmail', $currentTeamsEmail);
    }
}
