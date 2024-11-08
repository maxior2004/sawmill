<?php

namespace App\Entity;

use App\Repository\ShipmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShipmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Shipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'shipments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\Column]
    private ?int $count = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\PrePersist]
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTimeImmutable();
    }
    #[ORM\PrePersist]
    public function setPriceValue()
    {
        $this->price = $this->product->getPrice();
    }

    #[ORM\PrePersist]
    public function calculationCurrentCountProductInsert()
    {
        $total = $this->product->getCurrentCount() - $this->count;
        return $this->product->setCurrentCount($total);
    }
    #[ORM\PreRemove]
    public function calculationCurrentCountProductUpdate()
    {
        $total = $this->product->getCurrentCount() + $this->count;
        return $this->product->setCurrentCount($total);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): static
    {
        $this->count = $count;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
