<?php

namespace App\Entity;

use App\Repository\PlateRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlateRepository::class)]
class Plate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageSpine = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageFront = null;

    public function getId(): ?int { return $this->id; }

    public function getName(): ?string { return $this->name; }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string { return $this->description; }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getImageSpine(): ?string { return $this->imageSpine; }

    public function setImageSpine(?string $imageSpine): self
    {
        $this->imageSpine = $imageSpine;
        return $this;
    }

    public function getImageFront(): ?string { return $this->imageFront; }

    public function setImageFront(?string $imageFront): self
    {
        $this->imageFront = $imageFront;
        return $this;
    }
}
