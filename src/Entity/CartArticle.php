<?php

namespace App\Entity;

use App\Repository\CartArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartArticleRepository::class)]
class CartArticle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Article::class, inversedBy: 'cartArticles')]
    #[ORM\JoinColumn(nullable: false)]
    private $article;

    #[ORM\ManyToOne(targetEntity: Cart::class, inversedBy: 'cartArticles')]
    private $Cart;

    #[ORM\Column(type: 'integer')]
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->Cart;
    }

    public function setCart(?Cart $Cart): self
    {
        $this->Cart = $Cart;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
