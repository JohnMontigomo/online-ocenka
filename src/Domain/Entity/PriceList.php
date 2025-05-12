<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Interface\EntityInterface;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'price_list')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class PriceList implements EntityInterface
{
    #[ORM\Column(name: 'id', type: 'bigint', unique: true)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private ?int $id = null;

    #[ORM\Column(name: 'title', type: 'string', nullable: false)]
    private string $title;

    #[ORM\Column(name: 'price', type: 'integer', nullable: false)]
    private int $price;

    #[ORM\Column(name: 'valid_from', type: 'datetime', nullable: false)]
    private DateTime $validFrom;

    #[ORM\Column(name: 'expires_from', type: 'datetime', nullable: false)]
    private DateTime $expiresFrom;

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

    public function getValidFrom(): DateTime
    {
        return $this->validFrom;
    }

    public function setValidFrom(string $validFrom): void
    {
        $this->validFrom = DateTime::createFromFormat('Y-m-d H:i:s', $validFrom);
    }

    public function getExpiresFrom(): DateTime
    {
        return $this->expiresFrom;
    }

    public function setExpiresFrom(string $expiresFrom): void
    {
        $this->expiresFrom = DateTime::createFromFormat('Y-m-d H:i:s', $expiresFrom);
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
