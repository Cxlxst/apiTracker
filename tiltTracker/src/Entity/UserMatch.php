<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserMatchRepository;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: UserMatchRepository::class)]
#[ApiResource]
class UserMatch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $frags = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $morts = null;

    #[ORM\Column(type: 'integer')]
    private ?int $assists = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $nbMatchsGagnes = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $nbMatchsPerdus = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'userMatches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int {
        return $this->id;
    }

    public function getFrags(): ?int {
        return $this->frags;
    }

    public function setFrags(?int $frags): self {
        $this->frags = $frags;
        return $this;
    }

    public function getMorts(): ?int {
        return $this->morts;
    }

    public function setMorts(?int $morts): self {
        $this->morts = $morts;
        return $this;
    }

    public function getAssists(): ?int {
        return $this->assists;
    }

    public function setAssists(int $assists): self {
        $this->assists = $assists;
        return $this;
    }

    public function getNbMatchsGagnes(): ?int {
        return $this->nbMatchsGagnes;
    }

    public function setNbMatchsGagnes(?int $nbMatchsGagnes): self {
        $this->nbMatchsGagnes = $nbMatchsGagnes;
        return $this;
    }

    public function getNbMatchsPerdus(): ?int {
        return $this->nbMatchsPerdus;
    }

    public function setNbMatchsPerdus(?int $nbMatchsPerdus): self {
        $this->nbMatchsPerdus = $nbMatchsPerdus;
        return $this;
    }

    public function getUser(): ?User {
        return $this->user;
    }

    public function setUser(?User $user): self {
        $this->user = $user;
        return $this;
    }
}
