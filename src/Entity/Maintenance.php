<?php

namespace App\Entity;

use App\Repository\MaintenanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaintenanceRepository::class)]
class Maintenance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $serviceDate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $oilChange = null;

    #[ORM\Column(nullable: true)]
    //inspection des freins
    private ?bool $brakeInspection = null;

    #[ORM\Column(nullable: true)]
    //Changement de pneu
    private ?bool $tireChange = null;

    #[ORM\Column(nullable: true)]
    private ?bool $filterChange = null;

    #[ORM\Column(nullable: true)]
    //Climatisation
    private ?bool $fluidTopUp = null;

    #[ORM\ManyToOne(inversedBy: 'maintenances')]
    private ?Car $Car = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServiceDate(): ?\DateTimeInterface
    {
        return $this->serviceDate;
    }

    public function setServiceDate(?\DateTimeInterface $serviceDate): static
    {
        $this->serviceDate = $serviceDate;

        return $this;
    }

    public function isOilChange(): ?bool
    {
        return $this->oilChange;
    }

    public function setOilChange(?bool $oilChange): static
    {
        $this->oilChange = $oilChange;

        return $this;
    }

    public function isBrakeInspection(): ?bool
    {
        return $this->brakeInspection;
    }

    public function setBrakeInspection(?bool $brakeInspection): static
    {
        $this->brakeInspection = $brakeInspection;

        return $this;
    }

    public function isTireChange(): ?bool
    {
        return $this->tireChange;
    }

    public function setTireChange(?bool $tireChange): static
    {
        $this->tireChange = $tireChange;

        return $this;
    }

    public function isFilterChange(): ?bool
    {
        return $this->filterChange;
    }

    public function setFilterChange(?bool $filterChange): static
    {
        $this->filterChange = $filterChange;

        return $this;
    }

    public function isFluidTopUp(): ?bool
    {
        return $this->fluidTopUp;
    }

    public function setFluidTopUp(?bool $fluidTopUp): static
    {
        $this->fluidTopUp = $fluidTopUp;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->Car;
    }

    public function setCar(?Car $Car): static
    {
        $this->Car = $Car;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
