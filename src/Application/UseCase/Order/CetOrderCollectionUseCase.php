<?php

namespace App\Application\UseCase\Order;

use App\Domain\Service\OrderService;
use Symfony\Component\Security\Core\User\UserInterface;

class CetOrderCollectionUseCase
{
    public function __construct(
        private readonly OrderService  $orderService,
    ) {
    }

    public function __invoke(UserInterface $user): array
    {
        return $this->orderService->getOrderArrayByUser($user);
    }
}
