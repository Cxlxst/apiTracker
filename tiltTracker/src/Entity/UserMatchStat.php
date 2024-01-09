<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserMatchStatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserMatchStatRepository::class)]
#[ApiResource]
class UserMatchStat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userMatchStats')]
    private ?MatchUser $user_match = null;

    #[ORM\Column]
    private ?int $Killed = null;

    #[ORM\Column]
    private ?int $death = null;

    #[ORM\Column]
    private ?int $assist = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserMatch(): ?MatchUser
    {
        return $this->user_match;
    }

    public function setUserMatch(?MatchUser $user_match): static
    {
        $this->user_match = $user_match;

        return $this;
    }

    public function getKilled(): ?int
    {
        return $this->Killed;
    }

    public function setKilled(int $Killed): static
    {
        $this->Killed = $Killed;

        return $this;
    }

    public function getDeath(): ?int
    {
        return $this->death;
    }

    public function setDeath(int $death): static
    {
        $this->death = $death;

        return $this;
    }

    public function getAssist(): ?int
    {
        return $this->assist;
    }

    public function setAssist(int $assist): static
    {
        $this->assist = $assist;

        return $this;
    }
}
