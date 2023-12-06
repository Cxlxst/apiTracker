<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PartieRepository;

#[ORM\Entity(repositoryClass: PartieRepository::class)]
class Partie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity: UserMatch::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $userMatch;

    public function getId(): ?int {
        return $this->id;
    }

    public function getUserMatch(): ?UserMatch {
        return $this->userMatch;
    }

    public function setUserMatch(?UserMatch $userMatch): self {
        $this->userMatch = $userMatch;

        return $this;
    }
}
