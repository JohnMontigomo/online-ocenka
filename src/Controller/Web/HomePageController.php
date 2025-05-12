<?php

namespace App\Controller\Web;

use App\Controller\SiteRouteEnum\NameRouteEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class HomePageController extends AbstractController
{
    private const ROUTE_NAME = NameRouteEnum::AppHomePage->value;

    #[Route(path: '/', name: self::ROUTE_NAME, methods: ['GET'])]
    public function hello(): Response
    {
        return $this->render('home-page.html.twig');
    }
}
