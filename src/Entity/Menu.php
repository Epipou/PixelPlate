<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToMany(targetEntity: Plate::class)]
    #[ORM\JoinTable(name: 'menu_entrees')]
    private Collection $entrees;

    #[ORM\ManyToMany(targetEntity: Plate::class)]
    #[ORM\JoinTable(name: 'menu_plats')]
    private Collection $plats;

    #[ORM\ManyToMany(targetEntity: Plate::class)]
    #[ORM\JoinTable(name: 'menu_desserts')]
    private Collection $desserts;

    public function __construct()
    {
        $this->entrees = new ArrayCollection();
        $this->plats = new ArrayCollection();
        $this->desserts = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getName(): ?string { return $this->name; }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice(): ?float { return $this->price; }

    public function setPrice(float $price): static
    {
        $this->price = $price;
        return $this;
    }

    public function getDescription(): ?string { return $this->description; }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    // --- Entrées ---
    public function getEntrees(): Collection { return $this->entrees; }

    public function addEntree(Plate $plate): self
    {
        if (!$this->entrees->contains($plate)) {
            $this->entrees[] = $plate;
        }
        return $this;
    }

    public function removeEntree(Plate $plate): self
    {
        $this->entrees->removeElement($plate);
        return $this;
    }

    // --- Plats ---
    public function getPlats(): Collection { return $this->plats; }

    public function addPlat(Plate $plate): self
    {
        if (!$this->plats->contains($plate)) {
            $this->plats[] = $plate;
        }
        return $this;
    }

    public function removePlat(Plate $plate): self
    {
        $this->plats->removeElement($plate);
        return $this;
    }

    // --- Desserts ---
    public function getDesserts(): Collection { return $this->desserts; }

    public function addDessert(Plate $plate): self
    {
        if (!$this->desserts->contains($plate)) {
            $this->desserts[] = $plate;
        }
        return $this;
    }

    public function removeDessert(Plate $plate): self
    {
        $this->desserts->removeElement($plate);
        return $this;
    }
}
