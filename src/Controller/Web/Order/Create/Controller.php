<?php

namespace App\Controller\Web\Order\Create;

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
    private const CONTROLLER_URL  = UrlEnum::OrderCreateActualUrl->value;
    private const ROUTE_NAME      = NameRouteEnum::AppWebOrderCreate->value;

    public function __construct(
        private readonly Handler $handler,
    ) {
    }

    #[Route(path: self::CONTROLLER_URL, name: self::ROUTE_NAME, methods: ['GET', 'POST'])]
    public function __invoke(Request $request): Response
    {
        $optionsArray = $this->handler->handleForm($request);

        if ($optionsArray['redirect']) {
            return $this->redirectToRoute(NameRouteEnum::AppWebOrderConfirm->value);
        }

        return $this->render('order/order-create.html.twig', $optionsArray['options']);
    }
}
