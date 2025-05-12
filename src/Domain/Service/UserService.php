<?php

namespace App\Domain\Service;

use App\Domain\Entity\User;
use App\Domain\Model\UserModel;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function createUser(UserModel $userModel): void
    {
        $user = new User();
        $user->setEmail($userModel->email);
        $user->setFirstName($userModel->firstName);
        $user->setRoles($userModel->newRole);
        $user->setIsActive($userModel->isActive);
        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            $userModel->password
        ));

        $this->userRepository->create($user);
    }

    public function getUserByIdentifier(string $email): User
    {
        return $this->userRepository->getUserByIdentifier($email);
    }

    public function deleteAll(): void
    {
        $this->userRepository->deleteAll(User::class);
    }
}
