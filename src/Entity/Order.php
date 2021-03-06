<?php

namespace App\Entity;

use App\DBAL\Types\PaymentType;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Buyer::class, inversedBy: 'orders')]
    private ?Buyer $buyer;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'orders')]
    private ?Vendor $vendor;

    #[ORM\Column(type: 'integer')]
    private int $totalPrice;

    #[ORM\Column(type: 'boolean')]
    private bool $status;

    /**
     * @DoctrineAssert\Enum(entity=PaymentType::class)
     */
    #[ORM\Column(name: '`type`', type: 'PaymentType', nullable: false)]
    private ?string $paymentMethod;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\ManyToOne(targetEntity: CollectionPoint::class, inversedBy: 'orders')]
    private ?CollectionPoint $collectionPoint;

    /**
     * @var ArrayCollection<OrderArticle>
     */
    #[ORM\OneToMany(mappedBy: 'customerOrder', targetEntity: OrderArticle::class)]
    private Collection $orderArticles;

    public function __construct()
    {
        $this->orderArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTotalPrice(): ?int
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(int $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): self
    {
        PaymentType::assertValidChoice($paymentMethod);

        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCollectionPoint(): ?CollectionPoint
    {
        return $this->collectionPoint;
    }

    public function setCollectionPoint(?CollectionPoint $collectionPoint): self
    {
        $this->collectionPoint = $collectionPoint;

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
            $orderArticle->setCustomerOrder($this);
        }

        return $this;
    }

    public function removeOrderArticle(OrderArticle $orderArticle): self
    {
        if ($this->orderArticles->removeElement($orderArticle)) {
            // set the owning side to null (unless already changed)
            if ($orderArticle->getCustomerOrder() === $this) {
                $orderArticle->setCustomerOrder(null);
            }
        }

        return $this;
    }
}
