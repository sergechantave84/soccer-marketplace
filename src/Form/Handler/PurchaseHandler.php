<?php

namespace App\Form\Handler;

use App\Entity\Players;
use App\Entity\Sales;
use App\Entity\Teams;
use App\Repository\PlayersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class PurchaseHandler
{
    protected $playerJSON;
    protected PlayersRepository $playersRepository;
    protected EntityManagerInterface $entityManager;
    protected string $login;

    /**
     * @param mixed $playerJSON
     * @param PlayersRepository $playersRepository
     * @param EntityManagerInterface $entityManager
     * @param string $login
     */
    public function __construct(
        mixed $playerJSON,
        PlayersRepository $playersRepository,
        EntityManagerInterface $entityManager,
        string $login
    ) {
        $this->playerJSON = $playerJSON;
        $this->playersRepository = $playersRepository;
        $this->entityManager = $entityManager;
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function process(): mixed
    {
        $player = $this->playersRepository->find((int)$this->playerJSON->id);
        if ($player instanceof Players) {
            $team = $this->entityManager->getRepository(Teams::class)->findOneBy([
                'id' => $this->playerJSON->buyerTeamId
            ]);
            if ($team instanceof Teams) {
                $team->setMoneyBalance($team->getMoneyBalance() - (float)$this->playerJSON->playerSale);
            }
            $player->setTeam($team);
            $player->setUpForSale(false);
            $this->entityManager->flush();
        }

        return $player;
    }
}
