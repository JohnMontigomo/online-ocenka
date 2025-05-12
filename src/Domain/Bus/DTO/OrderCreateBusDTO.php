<?php

namespace App\Domain\Bus\DTO;

class OrderCreateBusDTO
{
    public function __construct(
        public string $email,
        public int    $priceListId,
        public string $userIdentifier,
    ) {
    }
}
