<?php

namespace App\Controller\Form\DTO;

use App\Application\Enum\MessageEnum;
use App\Domain\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

class OrderCreateDTO
{
    private const NOT_BLANK_MESSAGE = MessageEnum::NotBlankEmailMessage->value;

    #[Assert\NotBlank(message: self::NOT_BLANK_MESSAGE)]
    #[Assert\Email]
    public string $email;
    public int    $priceListId;
    public User   $user;
}
