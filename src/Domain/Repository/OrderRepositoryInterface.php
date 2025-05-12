<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Order;
use App\Domain\Entity\User;

interface OrderRepositoryInterface
{
    public function create(Order $order): int;

    /**
     * @param User $user
     * @return Order[]
     */
    public function getOrderArrayByUser(User $user): array;
}
