<?php

namespace App\Domain\Model;

use App\Domain\Entity\User;

class OrderModel
{
    public function __construct(
        public string  $email,
        public ?int    $priceListId,
        public ?User   $user,
        public ?string $title,
        public ?int    $price,
        public ?string $status,
        public ?string $createdAt,
    ) {
    }
}
