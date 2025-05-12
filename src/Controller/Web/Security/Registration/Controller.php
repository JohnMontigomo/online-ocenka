<?php

namespace App\Controller\Web\Security\Registration;

use App\Controller\SiteRouteEnum\NameRouteEnum;
use App\Controller\SiteRouteEnum\UrlEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsController]
class Controller extends AbstractController
{
    private const CONTROLLER_URL  = UrlEnum::Registration->value;
    private const ROUTE_NAME      = NameRouteEnum::AppRegistration->value;

    public function __construct(
        private readonly Handler $handler,
    ) {
    }

    #[Route(path: self::CONTROLLER_URL, name: self::ROUTE_NAME)]
    public function register(Request $request): Response
    {
        $optionsArray = $this->handler->register($request);

        if ($optionsArray['redirect']) {
            return $this->redirectToRoute(NameRouteEnum::AppLogin->value);
        }

        return $this->render('security/registration.html.twig', $optionsArray['options']);
    }
}
