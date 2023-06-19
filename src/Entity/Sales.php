<?php

namespace App\Entity;

use App\Repository\PlayersRepository;
use App\Repository\SalesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SalesRepository::class)]
class Sales
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['sale_read','sale_create'])]
    private ?int $id = null;

    #[ORM\ManyToOne(cascade: ['remove','persist'], inversedBy: 'players')]
    #[ORM\JoinColumn(nullable: false,onDelete: "CASCADE")]
    #[Groups(['sale_read','sale_create'])]
    private ?Players $player = null;

    #[ORM\Column(type: 'float')]
    #[Groups(['sale_read','sale_create'])]
    private ?float $amount;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Players|null
     */
    public function getPlayer(): ?Players
    {
        return $this->player;
    }

    /**
     * @param Players|null $player
     */
    public function setPlayer(?Players $player): void
    {
        $this->player = $player;
    }

    /**
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float|null $amount
     */
    public function setAmount(?float $amount): void
    {
        $this->amount = $amount;
    }
}
