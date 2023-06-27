<?php

namespace App\Entity;

use App\Repository\PlayersRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PlayersRepository::class)]
class Players
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['player_read','player_create'])]
    private ?int $id = null;

    #[ORM\ManyToOne(cascade: ['remove','persist'], inversedBy: 'players')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    #[Groups(['player_read','player_create'])]
    private ?Teams $team = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['player_read','player_create'])]
    private ?string $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['player_read','player_create'])]
    private ?string $surname;

    #[ORM\Column(type: 'boolean', length: 255)]
    #[Groups(['player_read','player_create'])]
    private ?bool $upForSale = false;

    #[ORM\OneToMany(mappedBy: 'player', targetEntity: Sales::class, cascade: ['persist','remove'], orphanRemoval: true)]
    private Collection $sales;

    private $salesJson;

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
     * @return Teams|null
     */
    public function getTeam(): ?Teams
    {
        return $this->team;
    }

    /**
     * @param Teams|null $team
     */
    public function setTeam(?Teams $team): void
    {
        $this->team = $team;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string|null $surname
     */
    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return bool|null
     */
    public function getUpForSale(): ?bool
    {
        return $this->upForSale;
    }

    /**
     * @param bool|null $upForSale
     */
    public function setUpForSale(?bool $upForSale): void
    {
        $this->upForSale = $upForSale;
    }

    /**
     * @return Collection
     */
    public function getSales(): Collection
    {
        return $this->sales;
    }

    /**
     * @param Collection $sales
     */
    public function setSales(Collection $sales): void
    {
        $this->sales = $sales;
    }

    public function addSales(Sales $sale): self
    {
        if (!$this->sales->contains($sale)) {
            $this->sales->add($sale);
            $sale->setPlayer($this);
        }

        return $this;
    }

    public function removeSales(Sales $sale): self
    {
        if ($this->sales->removeElement($sale)) {
            // set the owning side to null (unless already changed)
            if ($sale->getPlayer() === $this) {
                $sale->setPlayer(null);
            }
        }

        return $this;
    }

    #[Groups(['player_read', 'player_create'])]
    public function getSalesJson()
    {
        return $this->salesJson;
    }

    public function setSalesJson($salesJson)
    {
        $this->salesJson = $salesJson;
    }
}
