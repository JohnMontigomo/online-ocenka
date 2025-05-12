<?php

namespace App\Controller\Api\PriceList\Create\v1;

use App\Controller\SiteRouteEnum\NameRouteEnum;
use App\Controller\SiteRouteEnum\UrlEnum;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class Controller
{
    private const CONTROLLER_URL  = UrlEnum::PriceListCreateActualUrl->value;
    private const ROUTE_NAME      = NameRouteEnum::AppApiPriceListCreate->value;

    public function __construct(
        private readonly Handler $handler,
    ) {
    }

    #[Route(path: self::CONTROLLER_URL, name: self::ROUTE_NAME, methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] InputPriceListDTO $inputPriceListDTO): JsonResponse
    {
        return new JsonResponse($this->handler->create($inputPriceListDTO));
    }
}
