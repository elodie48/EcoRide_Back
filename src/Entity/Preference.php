<?php

namespace App\Entity;

use App\Repository\PreferenceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PreferenceRepository::class)]
class Preference
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $smoker = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $animal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $other = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSmoker(): ?string
    {
        return $this->smoker;
    }

    public function setSmoker(?string $smoker): static
    {
        $this->smoker = $smoker;

        return $this;
    }

    public function getAnimal(): ?string
    {
        return $this->animal;
    }

    public function setAnimal(?string $animal): static
    {
        $this->animal = $animal;

        return $this;
    }

    public function getOther(): ?string
    {
        return $this->other;
    }

    public function setOther(?string $other): static
    {
        $this->other = $other;

        return $this;
    }
}
