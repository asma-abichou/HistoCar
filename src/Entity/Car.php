<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $make = null;

    #[ORM\Column(length: 50)]
    private ?string $model = null;

    #[ORM\Column(length: 255)]
    private ?string $year = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $vin = null;

    #[ORM\Column]
    private ?int $mileAge = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $lastServiceDate = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?User $User = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMake(): ?string
    {
        return $this->make;
    }

    public function setMake(string $make): static
    {
        $this->make = $make;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getVin(): ?string
    {
        return $this->vin;
    }

    public function setVin(?string $vin): static
    {
        $this->vin = $vin;

        return $this;
    }

    public function getMileAge(): ?int
    {
        return $this->mileAge;
    }

    public function setMileAge(int $mileAge): static
    {
        $this->mileAge = $mileAge;

        return $this;
    }

    public function getLastServiceDate(): ?\DateTimeImmutable
    {
        return $this->lastServiceDate;
    }

    public function setLastServiceDate(\DateTimeImmutable $lastServiceDate): static
    {
        $this->lastServiceDate = $lastServiceDate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }
}
