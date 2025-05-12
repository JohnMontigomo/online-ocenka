<?php

namespace App\Domain\Bus;

use App\Domain\Bus\DTO\OrderCreateBusDTO;

interface OrderCreateHandleRequestBusInterface
{
    public function handleOrderCreate(OrderCreateBusDTO $orderCreateDTO, string $appEnv): bool;
}
