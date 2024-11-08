<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $summary = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?int $sizeX = null;

    #[ORM\Column(nullable: true)]
    private ?int $sizeY = null;

    #[ORM\Column(nullable: true)]
    private ?int $sizeZ = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\Column(nullable: true)]
    private ?int $currentCount = null;

    #[ORM\Column]
    private ?bool $status = null;


    /**
     * @var Collection<int, Production>
     */
    #[ORM\OneToMany(targetEntity: Production::class, mappedBy: 'product')]
    private Collection $productions;

    /**
     * @var Collection<int, Shipment>
     */
    #[ORM\OneToMany(targetEntity: Shipment::class, mappedBy: 'product')]
    private Collection $shipments;

    public function __construct()
    {
        $this->productions = new ArrayCollection();
        $this->shipments = new ArrayCollection();
    }

    #[ORM\PrePersist]
    public function setStatusValue()
    {
        $this->status = 1;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): static
    {
        $this->summary = $summary;

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

    public function getImageFile(): ?string
    {
        return $this->imageFile;
    }

    public function setImageFile(?string $imageFile): static
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    public function getSizeX(): ?int
    {
        return $this->sizeX;
    }

    public function setSizeX(?int $sizeX): static
    {
        $this->sizeX = $sizeX;

        return $this;
    }

    public function getSizeY(): ?int
    {
        return $this->sizeY;
    }

    public function setSizeY(?int $sizeY): static
    {
        $this->sizeY = $sizeY;

        return $this;
    }

    public function getSizeZ(): ?int
    {
        return $this->sizeZ;
    }

    public function setSizeZ(?int $sizeZ): static
    {
        $this->sizeZ = $sizeZ;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCurrentCount(): ?int
    {
        return $this->currentCount;
    }

    public function setCurrentCount(?int $currentCount): static
    {
        $this->currentCount = $currentCount;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

        return $this;
    }



    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Production>
     */
    public function getProductions(): Collection
    {
        return $this->productions;
    }

    public function addProduction(Production $production): static
    {
        if (!$this->productions->contains($production)) {
            $this->productions->add($production);
            $production->setProduct($this);
        }

        return $this;
    }

    public function removeProduction(Production $production): static
    {
        if ($this->productions->removeElement($production)) {
            // set the owning side to null (unless already changed)
            if ($production->getProduct() === $this) {
                $production->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Shipment>
     */
    public function getShipments(): Collection
    {
        return $this->shipments;
    }

    public function addShipment(Shipment $shipment): static
    {
        if (!$this->shipments->contains($shipment)) {
            $this->shipments->add($shipment);
            $shipment->setProduct($this);
        }

        return $this;
    }

    public function removeShipment(Shipment $shipment): static
    {
        if ($this->shipments->removeElement($shipment)) {
            // set the owning side to null (unless already changed)
            if ($shipment->getProduct() === $this) {
                $shipment->setProduct(null);
            }
        }

        return $this;
    }
}
