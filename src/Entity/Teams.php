<?php

namespace App\Entity;

use App\Repository\TeamsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[
    ORM\Entity(repositoryClass: TeamsRepository::class),
]
class Teams
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['player_read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['player_read'])]
    private ?string $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['player_read'])]
    private ?string $country;

    #[ORM\Column(type: 'float')]
    #[Groups(['player_read'])]
    private ?float $moneyBalance;

    #[ORM\OneToMany(mappedBy: 'team', targetEntity: Players::class, cascade: ['persist','remove'], orphanRemoval: true)]
    private Collection $players;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['player_read'])]
    private ?string $owner;

    public function __construct()
    {
        $this->players = new ArrayCollection();
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
     * @return float|null
     */
    public function getMoneyBalance(): ?float
    {
        return $this->moneyBalance;
    }

    /**
     * @param float|null $moneyBalance
     */
    public function setMoneyBalance(?float $moneyBalance): void
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
            $players->setTeam($this);
        }

        return $this;
    }

    public function removePlayers(Players $players): self
    {
        if ($this->players->removeElement($players)) {
            // set the owning side to null (unless already changed)
            if ($players->getTeam() === $this) {
                $players->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOwner(): ?string
    {
        return $this->owner;
    }

    /**
     * @param string|null $owner
     */
    public function setOwner(?string $owner): void
    {
        $this->owner = $owner;
    }
}
