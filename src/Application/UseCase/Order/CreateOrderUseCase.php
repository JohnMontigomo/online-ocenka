<?php

namespace App\Application\UseCase\Order;

use App\Domain\Bus\DTO\OrderCreateBusDTO;
use App\Domain\Factory\ModelFactory;
use App\Domain\Model\OrderModel;
use App\Domain\Service\OrderService;
use App\Domain\Service\UserService;

class CreateOrderUseCase
{
    public function __construct(
        private readonly ModelFactory $modelFactory,
        private readonly OrderService $orderService,
        private readonly UserService  $userService,
    ) {
    }

    public function createOrder(OrderCreateBusDTO $orderCreateDTO): void
    {
        $orderModel = $this->modelFactory->makeModel(
            OrderModel::class,
            $orderCreateDTO->email,
            $orderCreateDTO->priceListId,
            $this->userService->getUserByIdentifier($orderCreateDTO->userIdentifier),
            null,
            null,
            null,
            null,
        );

        $this->orderService->createOrder($orderModel);
    }
}
