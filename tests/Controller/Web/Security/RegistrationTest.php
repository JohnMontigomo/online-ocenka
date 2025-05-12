<?php

namespace App\Tests\Controller\Web\Security;

use App\Application\Enum\SelectorTextEnum;
use App\Controller\SiteRouteEnum\UrlEnum;
use App\Domain\Entity\User;
use App\Tests\Controller\Web\AbstractWebTestCase;

class RegistrationTest extends AbstractWebTestCase
{
    public function testRenderingRegistrationForm(): void
    {
        $this->client->request('GET', UrlEnum::Registration->value);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h5', SelectorTextEnum::RegistrationFormTitle->value);
        $this->assertSelectorCount(5, 'input');
        $this->assertAnySelectorTextContains('label', SelectorTextEnum::LabelEmail->value);
        $this->assertAnySelectorTextContains('label', SelectorTextEnum::LabelUserName->value);
        $this->assertAnySelectorTextContains('label', SelectorTextEnum::LabelPassword->value);
        $this->assertAnySelectorTextContains('label', SelectorTextEnum::LabelConfirmPassword->value);
        $this->assertAnySelectorTextContains('button', SelectorTextEnum::RegistrationFormButton->value);
    }

    public function testRegistration(): void
    {
        $this->registerUser();

        $userEmail = $this->getDataForUserRegistration()['email'];
        $testUser = $this->userService->getUserByIdentifier($userEmail);

        $this->assertResponseRedirects(UrlEnum::Login->value);
        $this->assertTrue($testUser instanceof User && $testUser->getEmail() === $userEmail);
    }
}
