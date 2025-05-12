<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;

/**
 * @extends AbstractRepository<User>
 */
class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function create(User $user): int
    {
        return $this->store($user);
    }

    public function getUserByIdentifier(string $email): User
    {
        return $this->entityManager->getRepository(User::class)->findOneBy(
            ['email' => $email]
        );
    }
}
