<?php

namespace App\Domain\Service;

use App\Application\Doctrine\EnumTypes\OrderStatusTypeEnum;
use App\Domain\Entity\Order;
use App\Domain\Entity\User;
use App\Domain\Factory\ModelFactory;
use App\Domain\Model\OrderModel;
use App\Domain\Repository\OrderRepositoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class OrderService
{
    public function __construct(
        private readonly ModelFactory             $modelFactory,
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly PriceListService         $priceListService
    ) {
    }

    public function createOrder(OrderModel $orderModel): void
    {
        $priceList = $this->priceListService->getPriceListById($orderModel->priceListId);

        $order = new Order();
        $order->setEmail($orderModel->email);
        $order->setPriceList($priceList);
        $order->setTitle($priceList->getTitle());
        $order->setPrice($priceList->getPrice());
        $order->setStatus(OrderStatusTypeEnum::Created);
        $order->setUser($orderModel->user);

        $this->orderRepository->create($order);
    }

    /**
     * @param User $user
     * @return OrderModel[]
     */
    public function getOrderArrayByUser(UserInterface $user): array
    {
        $orderObjectArray = $this->orderRepository->getOrderArrayByUser($user);

        return $this->buildOderModelArray($orderObjectArray);
    }

    /**
     * @param Order[] $orderObjectArray
     * @return OrderModel[]
     */
    private function buildOderModelArray(array $orderObjectArray): array
    {
        $orderModelArray = [];

        foreach ($orderObjectArray as $order) {
            $orderModel = $this->modelFactory->makeModel(
                OrderModel::class,
                $order->getEmail(),
                null,
                null,
                $order->getTitle(),
                $order->getPrice(),
                $order->getStatus()->value,
                $order->getCreatedAt()->format('d.m.y')
            );
            $orderModelArray[] = $orderModel;
        }

        return $orderModelArray;
    }

    public function deleteAll(): void
    {
        $this->orderRepository->deleteAll(Order::class);
    }
}
