<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column]
    private ?int $nb_match = null;

    #[ORM\OneToOne(mappedBy: 'user_id', cascade: ['persist', 'remove'])]
    private ?MatchUser $matchUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getNbMatch(): ?int
    {
        return $this->nb_match;
    }

    public function setNbMatch(int $nb_match): static
    {
        $this->nb_match = $nb_match;

        return $this;
    }

    public function getMatchUser(): ?MatchUser
    {
        return $this->matchUser;
    }

    public function setMatchUser(?MatchUser $matchUser): static
    {
        // unset the owning side of the relation if necessary
        if ($matchUser === null && $this->matchUser !== null) {
            $this->matchUser->setUserId(null);
        }

        // set the owning side of the relation if necessary
        if ($matchUser !== null && $matchUser->getUserId() !== $this) {
            $matchUser->setUserId($this);
        }

        $this->matchUser = $matchUser;

        return $this;
    }
}
