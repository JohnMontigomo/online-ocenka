<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Order;
use App\Domain\Entity\User;
use App\Domain\Repository\OrderRepositoryInterface;

/**
 * @extends AbstractRepository<Order>
 */
class OrderRepository extends AbstractRepository implements OrderRepositoryInterface
{
    public function create(Order $order): int
    {
        return $this->store($order);
    }

    /**
     * @param User $user
     * @return Order[]
     */
    public function getOrderArrayByUser(User $user): array
    {
        return  $this->entityManager->getRepository(Order::class)->findBy(['user' => $user]);
    }
}
