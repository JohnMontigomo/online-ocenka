<?php

namespace App\Controller\SiteRouteEnum;

enum NameRouteEnum: string
{
    case AppApiPriceListCreate = 'app_api_price_list_create';

    case AppHomePage              = 'app_home_page';
    case AppAbout                 = 'app_about';

    case AppLogin                 = 'app_login';
    case AppLogout                = 'app_logout';
    case AppRegistration          = 'app_registration';

    case AppWebOrderCreate        = 'app_web_order_create';
    case AppWebOrderConfirm       = 'app_web_order_confirm';
    case AppWebOrderGetCollection = 'app_web_order_get_collection';
}
