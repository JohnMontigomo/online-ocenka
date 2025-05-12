<?php

namespace App\Controller\Web\Security\Login;

use App\Application\Enum\SelectorTextEnum;
use App\Controller\SiteRouteEnum\NameRouteEnum;
use App\Controller\SiteRouteEnum\UrlEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[AsController]
class Controller extends AbstractController
{
    private const CONTROLLER_URL  = UrlEnum::Login->value;
    private const ROUTE_NAME      = NameRouteEnum::AppLogin->value;

    #[Route(path: self::CONTROLLER_URL, name: self::ROUTE_NAME)]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('security/login.html.twig', [
            'last_username'       => $authenticationUtils->getLastUsername(),
            'error'               => $authenticationUtils->getLastAuthenticationError(),
            'loginFormTitle'      => SelectorTextEnum::LoginFormTitle->value,
            'loginFormButtonText' => SelectorTextEnum::LoginFormButton->value,
            'labelEmail'          => SelectorTextEnum::LabelEmail->value,
            'labelPassword'       => SelectorTextEnum::LabelPassword->value,
        ]);
    }
}
