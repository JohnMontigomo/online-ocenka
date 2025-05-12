<?php

namespace App\Application\Enum;

enum MessageEnum: string
{
    case NotBlankEmailMessage  = 'Укажите email';

    case OrderCreatedSuccess   = 'Заказ сформирован, статус выполнения заказа вы можете проследить в списке заказов';
    case OrderCreatedError     = 'Возникла непредвиденная ошибка, пожалуйста попробуйте сделать заказ позже';

    case UserRegisterSuccess   = 'Пользователь успешно зарегистрирован, теперь вы можете войти и сделать заказ';
}
