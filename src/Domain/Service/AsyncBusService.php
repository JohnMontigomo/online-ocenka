<?php

namespace App\Domain\Service;

use App\Domain\Bus\DTO\OrderCreateBusDTO;
use App\Domain\Bus\OrderCreateHandleRequestBusInterface;

class AsyncBusService
{
    public function __construct(
        private readonly OrderCreateHandleRequestBusInterface $orderCreateHandleRequestBus
    ) {
    }

    public function handleOrderCreateByAsyncBus(OrderCreateBusDTO $orderCreateDTO, string $appEnv): bool
    {
        return $this->orderCreateHandleRequestBus->handleOrderCreate($orderCreateDTO, $appEnv);
    }
}
