<?php

namespace App\Controller\SiteRouteEnum;

enum UrlEnum: string
{
    case PriceListCreateActualUrl = '/api/price-list/v1';

    case About                    = '/about';

    case Login                    = '/login';
    case Registration             = '/registration';
    case Logout                   = '/logout';

    case OrderCreateActualUrl     = '/account/order-create';
    case OrderConfirmActualUrl    = '/account/order-confirm';
    case OrderGetCollection       = '/account/order-get-collection';
}
