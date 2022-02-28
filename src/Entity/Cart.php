<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(targetEntity: Buyer::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $buyer;

    #[ORM\OneToMany(mappedBy: 'Cart', targetEntity: CartArticle::class)]
    private $cartArticles;

    public function __construct()
    {
        $this->cartArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBuyer(): ?Buyer
    {
        return $this->buyer;
    }

    public function setBuyer(Buyer $buyer): self
    {
        $this->buyer = $buyer;

        return $this;
    }

    /**
     * @return Collection<int, CartArticle>
     */
    public function getCartArticles(): Collection
    {
        return $this->cartArticles;
    }

    public function addCartArticle(CartArticle $cartArticle): self
    {
        if (!$this->cartArticles->contains($cartArticle)) {
            $this->cartArticles[] = $cartArticle;
            $cartArticle->setCart($this);
        }

        return $this;
    }

    public function removeCartArticle(CartArticle $cartArticle): self
    {
        if ($this->cartArticles->removeElement($cartArticle)) {
            // set the owning side to null (unless already changed)
            if ($cartArticle->getCart() === $this) {
                $cartArticle->setCart(null);
            }
        }

        return $this;
    }
}
