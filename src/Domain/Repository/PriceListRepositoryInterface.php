<?php

namespace App\Domain\Repository;

use App\Domain\Entity\PriceList;

interface PriceListRepositoryInterface
{
    public function create(PriceList $priceList): int;

    /**
     * @return PriceList[]
     */
    public function getActualPriceList(): array;

    public function getPriceListById(int $id): PriceList;
}
