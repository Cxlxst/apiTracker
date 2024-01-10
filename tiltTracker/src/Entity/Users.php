<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['pseudo' => 'exact', 'motDePasse' => 'exact'])] //http://127.0.0.1:8080/api/userss?pseudo=Pseudo%201&motDePasse=MotDePasse123
// #[ApiFilter(SearchFilter::class, properties: ['pseudo' => 'ipartial'])] // http://127.0.0.1:8080/api/userss?pseudo=Pseudo


class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255)]
    private ?string $motDePasse = null;

    #[ORM\Column]
    private ?int $nb_match = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

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


    public function getstatut(): ?string
    {
        return $this->statut;
    }

    public function setstatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getmdp(): ?string
    {
        return $this->motDePasse;
    }

    public function setMdp(string $mdp): static
    {
        $this->motDePasse = $mdp;

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