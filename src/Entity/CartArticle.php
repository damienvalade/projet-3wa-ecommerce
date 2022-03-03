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
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Article::class, inversedBy: 'cartArticles')]
    #[ORM\JoinColumn(nullable: false)]
    private Article $article;

    #[ORM\ManyToOne(targetEntity: Cart::class, inversedBy: 'cartArticles')]
    private ?Cart $Cart;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    public static function wadCreated(Article $article,Cart $cart): self
    {
        $cartArticle = new self;
        $cartArticle->setArticle($article);
        $cartArticle->setCart($cart);
        $cartArticle->setQuantity(1);

        return $cartArticle;

    }

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
        // @phpstan-ignore-next-line
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
