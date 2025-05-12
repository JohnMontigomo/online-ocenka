<?php

namespace App\Controller\Web\Order\GetCollection;

use App\Application\UseCase\Order\CetOrderCollectionUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Handler extends AbstractController
{
    public function __construct(
        private readonly CetOrderCollectionUseCase $getOrderCollectionUseCase,
    ) {
    }

    public function __invoke(): array
    {
        return ['orderArray' => ($this->getOrderCollectionUseCase)($this->getUser()),];
    }
}
