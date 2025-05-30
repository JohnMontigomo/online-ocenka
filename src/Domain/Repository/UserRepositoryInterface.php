<?php

namespace App\Domain\Repository;

use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function create(User $user): int;

    public function getUserByIdentifier(string $email): User;
}

