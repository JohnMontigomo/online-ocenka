<?php

namespace App\Controller\Web\Order\Confirm;

use App\Controller\SiteRouteEnum\NameRouteEnum;
use App\Controller\SiteRouteEnum\UrlEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class Controller extends AbstractController
{
    private const CONTROLLER_URL  = UrlEnum::OrderConfirmActualUrl->value;
    private const ROUTE_NAME      = NameRouteEnum::AppWebOrderConfirm->value;

    #[Route(path: self::CONTROLLER_URL, name: self::ROUTE_NAME, methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        return $this->render('order/order-confirm.html.twig');
    }
}
