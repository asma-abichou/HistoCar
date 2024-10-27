<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\DBAL\Types\Types;
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



    #[ORM\Column]
    private ?int $mileAge = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $lastServiceDate = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?User $User = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $date = null;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(?\DateTimeImmutable $date): static
    {
        $this->date = $date;

        return $this;
    }
}
