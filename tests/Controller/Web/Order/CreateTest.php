<?php

namespace App\Tests\Controller\Web\Order;

use App\Application\Enum\MessageEnum;
use App\Application\Enum\SelectorTextEnum;
use App\Controller\SiteRouteEnum\UrlEnum;
use App\Tests\Controller\Web\AbstractWebTestCase;
use DAMA\DoctrineTestBundle\Doctrine\DBAL\StaticDriver;

class CreateTest extends AbstractWebTestCase
{
    public function testOrderCreateSuccess(): void
    {
        StaticDriver::setKeepStaticConnections(false);

        $this->createUser();
        $this->createPriceList();

        $userEmail = $this->getDataForUserRegistration()['email'];
        $testUser  = $this->userService->getUserByIdentifier($userEmail);

        $this->client->loginUser($testUser);
        $this->client->request('GET', UrlEnum::OrderCreateActualUrl->value);
        $this->client->submitForm(SelectorTextEnum::CreateOrderFormButton->value, [
            'order_form[priceListId]' => $this->getPriceList()[0]->id,
            'order_form[email]'       => $userEmail,
        ]);

        for ($i = 1; $i < 10; $i++) {
            sleep($i);
            $orderArray = $this->orderService->getOrderArrayByUser($testUser);
            if (count($orderArray) > 0) {
                break;
            }
        }

        $this->assertTrue($orderArray[0]->email === $userEmail);

        $this->orderService->deleteAll();
        $this->priceListService->deleteAll();
        $this->userService->deleteAll();

        StaticDriver::setKeepStaticConnections(true);
    }

    public function testSecurity(): void
    {
        $this->client->request('GET', UrlEnum::OrderCreateActualUrl->value);
        $this->client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h5', SelectorTextEnum::LoginFormTitle->value);
    }

    public function testRenderingOrderForm(): void
    {
        $this->createUser();
        $this->createPriceList();

        $testUser = $this->userService->getUserByIdentifier($this->getDataForUserRegistration()['email']);

        $this->client->loginUser($testUser);
        $this->client->request('GET', UrlEnum::OrderCreateActualUrl->value);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', SelectorTextEnum::CreateOrderFormTitle->value);
        $this->assertSelectorCount(2, 'input');
        $this->assertSelectorCount(1, 'select');
        $this->assertAnySelectorTextContains('label', SelectorTextEnum::LabelServiceSelect->value);
        $this->assertAnySelectorTextContains('label', SelectorTextEnum::LabelEmailForSendReport->value);
        $this->assertSelectorTextContains('button', SelectorTextEnum::CreateOrderFormButton->value);
    }

    public function testRenderingOrderConfirm(): void
    {
        $this->createUser();
        $this->createPriceList();

        $testUser = $this->userService->getUserByIdentifier($this->getDataForUserRegistration()['email']);

        $this->client->loginUser($testUser);
        $this->client->request('GET', UrlEnum::OrderCreateActualUrl->value);
        $this->client->submitForm(SelectorTextEnum::CreateOrderFormButton->value, [
            'order_form[priceListId]' => $this->getPriceList()[0]->id,
            'order_form[email]'       => $this->getDataForUserRegistration()['email'],
        ]);
        $this->client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertAnySelectorTextContains('div', MessageEnum::OrderCreatedSuccess->value);
    }

    public function testRenderingOrderWithError(): void
    {
        $this->createUser();
        $this->createPriceList();

        $testUser = $this->userService->getUserByIdentifier($this->getDataForUserRegistration()['email']);

        $this->client->loginUser($testUser);
        $this->client->request('GET', UrlEnum::OrderCreateActualUrl->value);
        $this->client->submitForm(SelectorTextEnum::CreateOrderFormButton->value, [
            'order_form[priceListId]' => $this->getPriceList()[0]->id,
            'order_form[email]'       => '',
        ]);

        $this->assertAnySelectorTextContains('li', MessageEnum::NotBlankEmailMessage->value);
    }
}

