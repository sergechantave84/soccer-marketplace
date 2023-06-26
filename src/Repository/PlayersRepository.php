<?php

namespace App\Repository;

use App\Entity\Players;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class PlayersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Players::class);
    }

    /**
     * @param string $currentTeamsEmail
     * @param bool|null $upForSale
     *
     * @return mixed
     */
    public function getPlayersForSale(string $currentTeamsEmail, ?bool $upForSale = null): mixed
    {
        $qp = $this->createQueryBuilder('p')
                   ->innerJoin('p.team','t')
                   ->where('t.owner = :currentTeamsEmail')
                   ->setParameter('currentTeamsEmail', $currentTeamsEmail);
        if (is_bool($upForSale)) {
            $qp->andWhere('p.upForSale = :upForSale')
               ->setParameter('upForSale', $upForSale);
        }

        return $qp->getQuery()->getResult();
    }

    /**
     * @param string $currentTeamsEmail
     *
     * @return QueryBuilder
     */
    public function getPlayersAvailable(string $currentTeamsEmail): QueryBuilder
    {
        return $this->createQueryBuilder('p')
                    ->innerJoin('p.team','t')
                    ->where('t.owner = :currentTeamsEmail')
                    ->andWhere('p.upForSale = false')
                    ->setParameter('currentTeamsEmail', $currentTeamsEmail);
    }

    /**
     * @param string $login
     * @param int|null $currentTeamsSelected
     *
     * @return mixed
     */
    public function getPlayersToPurchase(string $login, ?int $currentTeamsSelected): mixed
    {
        $queryBuilder = $this->createQueryBuilder('p')
                             ->innerJoin('p.team','t', Join::WITH, 't.owner <> :login')
                             ->where('p.upForSale = true')
                             ->setParameter('login', $login);
        if ($currentTeamsSelected) {
            $queryBuilder->andWhere('t.id = :currentTeamsSelected')
                         ->setParameter('currentTeamsSelected', $currentTeamsSelected);
        }

        return $queryBuilder->getQuery()->getResult();
    }
}
