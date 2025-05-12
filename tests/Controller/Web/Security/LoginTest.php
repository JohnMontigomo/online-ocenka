<?php

namespace App\Tests\Controller\Web\Security;

use App\Application\Enum\SelectorTextEnum;
use App\Controller\SiteRouteEnum\UrlEnum;
use App\Tests\Controller\Web\AbstractWebTestCase;

class LoginTest extends AbstractWebTestCase
{
    public function testRenderingLoginForm(): void
    {
        $this->client->request('GET', UrlEnum::Login->value);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h5', SelectorTextEnum::LoginFormTitle->value);
        $this->assertSelectorCount(3, 'input');
        $this->assertAnySelectorTextContains('label', SelectorTextEnum::LabelEmail->value);
        $this->assertAnySelectorTextContains('label', SelectorTextEnum::LabelPassword->value);
        $this->assertAnySelectorTextContains('button', SelectorTextEnum::LoginFormButton->value);
    }
}
