<?php

namespace App\Controller\Form\DTO;

use App\Controller\Validator\UniqueUser;
use Symfony\Component\Validator\Constraints as Assert;

class UserRegistrationDTO
{
    #[Assert\NotBlank(message: 'Укажите email')]
    #[Assert\Email]
    #[UniqueUser]
    public string $email;

    #[Assert\NotBlank(message: 'Укажите ваше имя')]
    public string $firstName;

    #[Assert\NotBlank(message: 'Укажите пароль')]
    #[Assert\Length(min: "6", minMessage: "Пароль должен быть длиной не менее 6 символов")]
    public string $plainPassword;

    #[Assert\NotBlank(message: 'Повторите пароль')]
    #[Assert\EqualTo(propertyPath: "plainPassword", message: "Пароли должны совпадать")]
    public string $confirmPassword;
}
