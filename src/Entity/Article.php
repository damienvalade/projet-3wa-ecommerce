<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\Column(type: 'integer')]
    private int $price;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $photo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $origin;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'articles')]
    private ?Vendor $vendor = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'articles')]
    private ?Category $category;

    /**
     * @var ArrayCollection<Feedback>
     */
    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Feedback::class)]
    private Collection $feedback;

    /**
     * @var ArrayCollection<OrderArticle>
     */
    #[ORM\OneToMany(mappedBy: 'article', targetEntity: OrderArticle::class)]
    private Collection $orderArticles;

    /**
     * @var ArrayCollection<CartArticle>
     */
    #[ORM\OneToMany(mappedBy: 'article', targetEntity: CartArticle::class)]
    private Collection $cartArticles;

    public function __construct()
    {
        $this->feedback = new ArrayCollection();
        $this->orderArticles = new ArrayCollection();
        $this->cartArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(?string $origin): self
    {
        $this->origin = $origin;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Feedback>
     */
    public function getFeedback(): Collection
    {
        return $this->feedback;
    }

    public function addFeedback(Feedback $feedback): self
    {
        if (!$this->feedback->contains($feedback)) {
            $this->feedback[] = $feedback;
            $feedback->setArticle($this);
        }

        return $this;
    }

    public function removeFeedback(Feedback $feedback): self
    {
        if ($this->feedback->removeElement($feedback)) {
            // set the owning side to null (unless already changed)
            if ($feedback->getArticle() === $this) {
                $feedback->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OrderArticle>
     */
    public function getOrderArticles(): Collection
    {
        return $this->orderArticles;
    }

    public function addOrderArticle(OrderArticle $orderArticle): self
    {
        if (!$this->orderArticles->contains($orderArticle)) {
            $this->orderArticles[] = $orderArticle;
            $orderArticle->setArticle($this);
        }

        return $this;
    }

    public function removeOrderArticle(OrderArticle $orderArticle): self
    {
        if ($this->orderArticles->removeElement($orderArticle)) {
            // set the owning side to null (unless already changed)
            if ($orderArticle->getArticle() === $this) {
                $orderArticle->setArticle(null);
            }
        }

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
            $cartArticle->setArticle($this);
        }

        return $this;
    }

    public function removeCartArticle(CartArticle $cartArticle): self
    {
        if ($this->cartArticles->removeElement($cartArticle)) {
            // set the owning side to null (unless already changed)
            if ($cartArticle->getArticle() === $this) {
                $cartArticle->setArticle(null);
            }
        }

        return $this;
    }
}
