<?php

namespace App\Controller\Api\PriceList\Create\v1;

use Symfony\Component\Validator\Constraints as Assert;

class InputPriceListDTO
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $title,
        #[Assert\NotBlank]
        public readonly int    $price,
        #[Assert\NotBlank]
        public readonly string $expiresFrom,
        #[Assert\NotBlank]
        public readonly string $validFrom,
    ) {
    }
}
