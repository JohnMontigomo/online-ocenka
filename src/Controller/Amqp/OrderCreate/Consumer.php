<?php

namespace App\Controller\Amqp\OrderCreate;

use App\Application\RabbitMq\AbstractConsumer;
use App\Application\UseCase\Order\CreateOrderUseCase;
use App\Domain\Bus\DTO\OrderCreateBusDTO;
use App\Domain\Factory\ModelFactory;

class Consumer extends AbstractConsumer
{
    public function __construct(
        private readonly ModelFactory       $modelFactory,
        private readonly CreateOrderUseCase $createOrderUseCase,
    ) {
    }

    protected function getMessageClass(): string
    {
        return Message::class;
    }

    /**
     * @param Message $message
     */
    protected function handle($message): int
    {
        $orderBusDTO = $this->modelFactory->makeModel(
            OrderCreateBusDTO::class,
            $message->email,
            $message->priceListId,
            $message->userIdentifier,
        );

        $this->createOrderUseCase->createOrder($orderBusDTO);

        return self::MSG_ACK;
    }
}
