<?php

namespace App\Controller\Web\Security\Logout;

use App\Controller\SiteRouteEnum\NameRouteEnum;
use App\Controller\SiteRouteEnum\UrlEnum;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class Controller extends AbstractController
{
    private const CONTROLLER_URL  = UrlEnum::Logout->value;
    private const ROUTE_NAME      = NameRouteEnum::AppLogout->value;

    #[Route(path: self::CONTROLLER_URL, name: self::ROUTE_NAME)]
    public function logout(): Response
    {
        throw new LogicException();
    }
}
