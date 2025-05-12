<?php

namespace App\Application\Enum;

enum SelectorTextEnum: string
{
    case LabelEmail              = 'Email';
    case LabelPassword           = 'Пароль';
    case LabelConfirmPassword    = 'подтверждение пароля';
    case LabelUserName           = 'Ваше имя';

    case LoginFormTitle          = 'Вход в личный кабинет';
    case LoginFormButton         = 'Войти';

    case RegistrationFormTitle   = 'Регистрация';
    case RegistrationFormButton  = 'Зарегистрироваться';

    case CreateOrderFormTitle    = 'Заказать услугу оценки';
    case LabelServiceSelect      = 'Выберите услугу';
    case LabelEmailForSendReport = 'Email для отправки отчёта';
    case SpanServicePrice        = 'Цена услуги';
    case CreateOrderFormButton   = 'Подтвердить';
}
