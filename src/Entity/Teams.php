<?php

namespace App\Entity;

use App\Repository\TeamsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[
    ORM\Entity(repositoryClass: TeamsRepository::class),
]
class Teams
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $country;

    #[ORM\Column(type: 'float')]
    private ?string $moneyBalance;

    #[ORM\OneToMany(mappedBy: 'campaign', targetEntity: Players::class, cascade: ['persist','remove'], orphanRemoval: true)]
    private Collection $players;

    public function __construct()
    {
        $this->siteEngines = new ArrayCollection();
    }

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
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     */
    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string|null
     */
    public function getMoneyBalance(): ?string
    {
        return $this->moneyBalance;
    }

    /**
     * @param string|null $moneyBalance
     */
    public function setMoneyBalance(?string $moneyBalance): void
    {
        $this->moneyBalance = $moneyBalance;
    }

    /**
     * @return Collection<int, Players>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    /**
     * @param Collection $players
     */
    public function setPlayers(Collection $players): void
    {
        $this->players = $players;
    }

    public function addPlayers(Players $players): self
    {
        if (!$this->players->contains($players)) {
            $this->players->add($players);
            $players->setTeams($this);
        }

        return $this;
    }

    public function removePlayers(Players $players): self
    {
        if ($this->siteEngines->removeElement($players)) {
            // set the owning side to null (unless already changed)
            if ($players->getTeams() === $this) {
                $players->setTeams(null);
            }
        }

        return $this;
    }
}
