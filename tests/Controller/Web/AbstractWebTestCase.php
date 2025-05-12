<?php

namespace App\Tests\Controller\Web;

use App\Application\Enum\SelectorTextEnum;
use App\Controller\SiteRouteEnum\UrlEnum;
use App\Domain\Enum\UserRoleEnum;
use App\Domain\Factory\ModelFactory;
use App\Domain\Model\PriceListModel;
use App\Domain\Model\UserModel;
use App\Domain\Service\OrderService;
use App\Domain\Service\PriceListService;
use App\Domain\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AbstractWebTestCase extends WebTestCase
{
    protected $client;
    protected readonly UserService $userService;
    protected readonly OrderService $orderService;
    protected readonly PriceListService $priceListService;
    protected readonly ModelFactory $modelFactory;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->modelFactory = static::getContainer()->get(ModelFactory::class);
        $this->userService = static::getContainer()->get(UserService::class);
        $this->orderService = static::getContainer()->get(OrderService::class);
        $this->priceListService = static::getContainer()->get(PriceListService::class);

        parent::setUp();
    }

    protected function registerUser(): void
    {
        $this->client->request('GET', UrlEnum::Registration->value);

        $this->client->submitForm(SelectorTextEnum::RegistrationFormButton->value, [
            'user_registration_form[email]'           => $this->getDataForUserRegistration()['email'],
            'user_registration_form[firstName]'       => $this->getDataForUserRegistration()['firstName'],
            'user_registration_form[plainPassword]'   => $this->getDataForUserRegistration()['plainPassword'],
            'user_registration_form[confirmPassword]' => $this->getDataForUserRegistration()['confirmPassword'],
        ]);
    }

    protected function createUser(): void
    {
        $userModel = $this->modelFactory->makeModel(
            UserModel::class,
            null,
            $this->getDataForUserRegistration()['email'],
            $this->getDataForUserRegistration()['firstName'],
            $this->getDataForUserRegistration()['plainPassword'],
            UserRoleEnum::ROLE_USER->value,
            null,
            true,
        );
        $this->userService->createUser($userModel);
    }

    protected function createPriceList(): void
    {
        $priceListModel = $this->modelFactory->makeModel(
            PriceListModel::class,
            $this->getDataForPriceList()['id'],
            $this->getDataForPriceList()['title'],
            $this->getDataForPriceList()['price'],
            $this->getDataForPriceList()['validFrom'],
            $this->getDataForPriceList()['expiresFrom'],
        );

        $this->priceListService->create($priceListModel);
    }

    protected function getPriceList(): array
    {
        return static::getContainer()->get(PriceListService::class)->getActualPriceList();
    }

    protected function getDataForUserRegistration(): array
    {
        return [
            'email'           => 'abstract-web-test-case@example.com',
            'firstName'       => 'John',
            'plainPassword'   => '123456',
            'confirmPassword' => '123456',
        ];
    }

    protected function getDataForPriceList(): array
    {
        return [
            'id'          => null,
            'title'       => 'abstract-web-test-case',
            'price'       => 1000,
            'validFrom'   => '2025-01-01 00:00:01',
            'expiresFrom' => '2025-12-31 00:00:00',
        ];
    }
}
