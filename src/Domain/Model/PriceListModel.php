<?php

namespace App\Domain\Model;

class PriceListModel
{
    public function __construct(
        public ?int    $id,
        public string  $title,
        public int     $price,
        public ?string $validFrom,
        public ?string $expiresFrom,
    ) {
    }
}
