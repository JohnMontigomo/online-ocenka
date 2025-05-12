<?php

namespace App\Controller\Amqp\OrderCreateTest;

class Message
{
    public function __construct(
        public readonly string $email,
        public readonly int    $priceListId,
        public readonly string $userIdentifier,
    ) {
    }
}
