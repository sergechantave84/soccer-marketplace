<?php

namespace App\Entity;

use App\Repository\PlayersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayersRepository::class)]
class Players
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(cascade: ['remove','persist'], inversedBy: 'players')]
    #[ORM\JoinColumn(nullable: false,onDelete: "CASCADE")]
    private ?Teams $teams = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $surname;

    #[ORM\Column(type: 'boolean', length: 255)]
    private ?bool $upForSale = false;

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
    public function getTeams(): ?Teams
    {
        return $this->teams;
    }

    /**
     * @param Teams|null $teams
     */
    public function setTeams(?Teams $teams): void
    {
        $this->teams = $teams;
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
}
