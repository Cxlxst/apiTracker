<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $pseudo = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $niveau_compte = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $nbMatch = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $statut = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserMatch::class, orphanRemoval: true)]
    private Collection $userMatches;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Partie::class, orphanRemoval: true)]
    private Collection $parties;

    public function __construct() {
        $this->userMatches = new ArrayCollection();
        $this->parties = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getPseudo(): ?string {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function getNiveauCompte(): ?int {
        return $this->niveau_compte;
    }

    public function setNiveauCompte(?int $niveau_compte): self {
        $this->niveau_compte = $niveau_compte;
        return $this;
    }

    public function getNbMatch(): ?int {
        return $this->nbMatch;
    }

    public function setNbMatch(?int $nbMatch): self {
        $this->nbMatch = $nbMatch;
        return $this;
    }

    public function getStatut(): ?string {
        return $this->statut;
    }

    public function setStatut(?string $statut): self {
        $this->statut = $statut;
        return $this;
    }

    /**
     * @return Collection|UserMatch[]
     */
    public function getUserMatches(): Collection {
        return $this->userMatches;
    }

    public function addUserMatch(UserMatch $userMatch): self {
        if (!$this->userMatches->contains($userMatch)) {
            $this->userMatches[] = $userMatch;
            $userMatch->setUser($this);
        }
        return $this;
    }

    public function removeUserMatch(UserMatch $userMatch): self {
        if ($this->userMatches->removeElement($userMatch)) {
            if ($userMatch->getUser() === $this) {
                $userMatch->setUser(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|Partie[]
     */
    public function getParties(): Collection {
        return $this->parties;
    }

    public function addPartie(Partie $partie): self {
        if (!$this->parties->contains($partie)) {
            $this->parties[] = $partie;
            $partie->setUser($this);
        }
        return $this;
    }

    public function removePartie(Partie $partie): self {
        if ($this->parties->removeElement($partie)) {
            if ($partie->getUser() === $this) {
                $partie->setUser(null);
            }
        }
        return $this;
    }
}
