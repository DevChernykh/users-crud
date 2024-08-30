<?php

namespace App\Entity;

use App\Repository\FriendsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FriendsRepository::class)]
class Friends
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $leftId = null;

    #[ORM\Column]
    private ?int $rightId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeftId(): ?int
    {
        return $this->leftId;
    }

    public function setLeftId(int $leftId): static
    {
        $this->leftId = $leftId;

        return $this;
    }

    public function getRightId(): ?int
    {
        return $this->rightId;
    }

    public function setRightId(int $rightId): static
    {
        $this->rightId = $rightId;

        return $this;
    }
}
