<?php

namespace App\Controller\Api\PriceList\Create\v1;

class OutputPriceListDTO
{
    public function __construct(
        public readonly int    $id,
        public readonly string $title,
        public readonly int    $price,
        public readonly string $expiresFrom,
        public readonly string $validFrom,
    ) {
    }
}
