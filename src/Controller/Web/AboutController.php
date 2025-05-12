<?php

namespace App\Controller\Web;

use App\Controller\SiteRouteEnum\NameRouteEnum;
use App\Controller\SiteRouteEnum\UrlEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class AboutController extends AbstractController
{
    private const CONTROLLER_UR = UrlEnum::About->value;
    private const ROUTE_NAME    = NameRouteEnum::AppAbout->value;

    #[Route(path: self::CONTROLLER_UR, name: self::ROUTE_NAME, methods: ['GET'])]
    public function hello(): Response
    {
        return $this->render('about.html.twig');
    }
}
