<?php

namespace App\Controller\Amqp\OrderCreate;

class Message
{
    public function __construct(
        public readonly string $email,
        public readonly int    $priceListId,
        public readonly string $userIdentifier,
    ) {
    }
}
