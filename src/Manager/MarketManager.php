<?php

namespace App\Manager;

use App\Repository\PlayersRepository;
use App\Repository\TeamsRepository;
use JetBrains\PhpStorm\ArrayShape;

class MarketManager
{
    private PlayersRepository $playersRepository;
    private TeamsRepository $teamsRepository;

    public function __construct(PlayersRepository $playersRepository, TeamsRepository $teamsRepository)
    {
        $this->playersRepository = $playersRepository;
        $this->teamsRepository = $teamsRepository;
    }

    #[ArrayShape(['buyerTeam'         => "mixed|null|object",
                  'playersToUpSale'   => "mixed",
                  'playersAvailable'  => "int|mixed|string",
                  'playersToPurchase' => "mixed",
                  'myPlayers'         => "mixed"
    ])] public function dataMarketPages(string $login): array
    {
        return [
            'buyerTeam'         => $this->teamsRepository->findOneBy(['owner'=>$login]),
            'playersToUpSale'   => $this->playersRepository->getPlayersForSale($login, true),
            'playersAvailable'  => $this->playersRepository->getPlayersAvailable($login)->getQuery()->getResult(),
            'playersToPurchase' => $this->playersRepository->getPlayersToPurchase($login, null),
            'myPlayers'         => $this->playersRepository->getPlayersForSale($login),
        ];
    }
}
