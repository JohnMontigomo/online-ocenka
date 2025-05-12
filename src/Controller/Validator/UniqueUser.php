<?php

namespace App\Controller\Validator;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class UniqueUser extends Constraint
{
    /**
     * @var string $message
     */
    public $message = 'Email "{{ value }}" уже зарегистрирован';
}
