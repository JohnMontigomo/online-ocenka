<?php

namespace App\Controller\Validator;

use App\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueUserValidator extends ConstraintValidator
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly Security $security) {
    }

    public function validate($value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        switch ($this->security->getUser()) {
            case null:
                if (!$this->em->getRepository(User::class)->findOneBy(['email' => $value])) {
                    return;
                }
                break;
            case !null:
                if ($this->em->getRepository(User::class)->findOneBy(['email' => $value]) === $this->security->getUser()
                    || !$this->em->getRepository(User::class)->findOneBy(['email' => $value])) {
                    return;
                }
                break;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}

