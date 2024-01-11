<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ConnexionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConnexionRepository::class)]
#[ApiResource]
//#[ApiFilter(SearchFilter::class, properties: ['pseudo' => 'exact', 'motDePasse' => 'exact'])] //http://127.0.0.1:8080/api/userss?pseudo=Pseudo%201&motDePasse=MotDePasse123
class Connexion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Users $user = null;

    #[ORM\Column(length: 255)]
    private ?string $MDP = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getMDP(): ?string
    {
        return $this->MDP;
    }

    public function setMDP(string $MDP): static
    {
        $this->MDP = $MDP;

        return $this;
    }
}
