<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MatchUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;

#[ORM\Entity(repositoryClass: MatchUserRepository::class)]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['user_id' => 'exact'])]
#[ApiResource(paginationEnabled: false)]

class MatchUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'matchUser')]
    private ?Users $user_id = null;

    #[ORM\Column]
    private ?int $match_id = null;

    #[ORM\Column]
    private ?bool $win = null;

    #[ORM\OneToMany(mappedBy: 'user_match', targetEntity: UserMatchStat::class)]
    private Collection $userMatchStats;

    public function __construct()
    {
        $this->userMatchStats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?Users
    {
        return $this->user_id;
    }

    public function setUserId(?Users $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getMatchId(): ?int
    {
        return $this->match_id;
    }

    public function setMatchId(int $match_id): static
    {
        $this->match_id = $match_id;

        return $this;
    }

    public function isWin(): ?bool
    {
        return $this->win;
    }

    public function setWin(bool $win): static
    {
        $this->win = $win;

        return $this;
    }

    /**
     * @return Collection<int, UserMatchStat>
     */
    public function getUserMatchStats(): Collection
    {
        return $this->userMatchStats;
    }

    public function addUserMatchStat(UserMatchStat $userMatchStat): static
    {
        if (!$this->userMatchStats->contains($userMatchStat)) {
            $this->userMatchStats->add($userMatchStat);
            $userMatchStat->setUserMatch($this);
        }

        return $this;
    }

    public function removeUserMatchStat(UserMatchStat $userMatchStat): static
    {
        if ($this->userMatchStats->removeElement($userMatchStat)) {
            // set the owning side to null (unless already changed)
            if ($userMatchStat->getUserMatch() === $this) {
                $userMatchStat->setUserMatch(null);
            }
        }

        return $this;
    }
}