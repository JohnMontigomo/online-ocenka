<?php

namespace App\Domain\Model;

class UserModel
{
    public function __construct(
        public ?int    $id,
        public string  $email,
        public string  $firstName,
        public ?string $password,
        public ?string $newRole,
        public ?array  $roles,
        public true    $isActive
    ) {
    }
}
