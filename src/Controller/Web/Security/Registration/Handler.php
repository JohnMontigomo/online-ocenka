<?php

namespace App\Controller\Web\Security\Registration;

use App\Application\Enum\MessageEnum;
use App\Application\Enum\SelectorTextEnum;
use App\Controller\Form\DTO\UserRegistrationDTO;
use App\Controller\Form\UserRegistrationFormType;
use App\Domain\Enum\UserRoleEnum;
use App\Domain\Factory\ModelFactory;
use App\Domain\Model\UserModel;
use App\Domain\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class Handler extends AbstractController
{
    public function __construct(
        /** @var ModelFactory<UserModel> */
        private readonly ModelFactory     $modelFactory,
        private readonly UserService      $userService,
    ) {
    }

    public function register(Request $request): array
    {
        $form = $this->createForm(UserRegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UserRegistrationDTO $userDTO */
            $userDTO = $form->getData();
            $this->createUser($userDTO);

            $this->addFlash(
                'user_register_success',
                MessageEnum::UserRegisterSuccess->value
            );

            $redirect = true;
        }

        return [
            'options' => [
                'registrationForm'       => $form->createView(),
                'registrationFormTitle'  => SelectorTextEnum::RegistrationFormTitle->value,
                'labelEmail'             => SelectorTextEnum::LabelEmail->value,
                'userName'               => SelectorTextEnum::LabelUserName->value,
                'labelPassword'          => SelectorTextEnum::LabelPassword->value,
                'labelConfirmPassword'   => SelectorTextEnum::LabelConfirmPassword->value,
                'registrationFormButton' => SelectorTextEnum::RegistrationFormButton->value,
            ],
            'redirect' => $redirect ?? false,
        ];
    }

    private function createUser(UserRegistrationDTO $userDTO): void
    {
        $userModel = $this->modelFactory->makeModel(
            UserModel::class,
            null,
            $userDTO->email,
            $userDTO->firstName,
            $userDTO->plainPassword,
            UserRoleEnum::ROLE_USER->value,
            null,
            true,
        );
        $this->userService->createUser($userModel);
    }
}
