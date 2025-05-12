<?php

namespace App\Infrastructure\Bus\Adapter;

use App\Domain\Bus\DTO\OrderCreateBusDTO;
use App\Domain\Bus\OrderCreateHandleRequestBusInterface;
use App\Domain\Enum\AmqpExchangeEnum;
use App\Infrastructure\Bus\RabbitMqBus;

class OrderCreateHandleRequestBus implements OrderCreateHandleRequestBusInterface
{
    public function __construct(private readonly RabbitMqBus $rabbitMqBus)
    {
    }

    public function  handleOrderCreate(OrderCreateBusDTO $orderCreateDTO, string $appEnv): bool
    {
        return $this->rabbitMqBus->publishToExchange(AmqpExchangeEnum::OrderCreate, $orderCreateDTO, $appEnv);
    }
}
