<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'smallint')]
    private int $note;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAd;

    #[ORM\ManyToOne(targetEntity: Buyer::class, inversedBy: 'notes')]
    private ?Buyer $buyer;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'notes')]
    private ?Vendor $vendor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getCreatedAd(): ?\DateTimeInterface
    {
        return $this->createdAd;
    }

    public function setCreatedAd(\DateTimeInterface $createdAd): self
    {
        $this->createdAd = $createdAd;

        return $this;
    }

    public function getBuyer(): ?Buyer
    {
        return $this->buyer;
    }

    public function setBuyer(?Buyer $buyer): self
    {
        $this->buyer = $buyer;

        return $this;
    }

    public function getVendor(): ?Vendor
    {
        return $this->vendor;
    }

    public function setVendor(?Vendor $vendor): self
    {
        $this->vendor = $vendor;

        return $this;
    }
}
