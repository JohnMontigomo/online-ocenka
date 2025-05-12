<?php

namespace App\Domain\Entity;

use App\Application\Doctrine\EnumTypes\OrderStatusTypeEnum;
use App\Domain\Entity\Interface\EntityInterface;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Table(name: '`order`')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Order implements EntityInterface
{
    #[ORM\Column(name: 'id', type: 'bigint', unique: true)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private ?int $id = null;

    #[ORM\Column(name: 'email', type: 'string', nullable: false)]
    private string $email;

    #[ManyToOne(targetEntity: PriceList::class)]
    private PriceList $priceList;

    #[ManyToOne(targetEntity: User::class)]
    private User $user;

    #[ORM\Column(name: 'title', type: 'string', nullable: false)]
    private string $title;

    #[ORM\Column(name: 'price', type: 'integer', nullable: false)]
    private int $price;

    #[ORM\Column(name: 'status', type: 'string', nullable: false, enumType: OrderStatusTypeEnum::class)]
    private OrderStatusTypeEnum $status;

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false)]
    private DateTime $createdAt;

    #[ORM\Column(name: 'updated_at', type: 'datetime', nullable: false)]
    private DateTime $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPriceList(): PriceList
    {
        return $this->priceList;
    }

    public function setPriceList(PriceList $priceList): void
    {
        $this->priceList = $priceList;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function getStatus(): OrderStatusTypeEnum
    {
        return $this->status;
    }

    public function setStatus(OrderStatusTypeEnum $status): void
    {
        $this->status = $status;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt(): void
    {
        $this->createdAt = new DateTime();
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setUpdatedAt(): void
    {
        $this->updatedAt = new DateTime();
    }
}
