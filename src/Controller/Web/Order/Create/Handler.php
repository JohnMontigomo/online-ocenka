<?php

namespace App\Controller\Web\Order\Create;

use App\Application\Enum\MessageEnum;
use App\Application\Enum\SelectorTextEnum;
use App\Controller\Form\DTO\OrderCreateDTO;
use App\Controller\Form\OrderFormType;
use App\Domain\Bus\DTO\OrderCreateBusDTO;
use App\Domain\Factory\ModelFactory;
use App\Domain\Service\AsyncBusService;
use App\Domain\Service\PriceListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class Handler extends AbstractController
{
    public function __construct(
        private readonly ModelFactory     $modelFactory,
        private readonly PriceListService $priceListService,
        private readonly AsyncBusService  $asyncBusService,
    ) {
    }

    public function handleForm(Request $request): array
    {
        $form = $this->createForm(OrderFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var OrderCreateDTO $orderCreateDTO */
            $orderCreateDTO = $form->getData();

            $bus = $this->createOrderAsync($orderCreateDTO);

            if ($bus) {
                $this->addFlash(
                    'order_created',
                    MessageEnum::OrderCreatedSuccess->value
                );
            } else {
                $this->addFlash(
                    'order_error',
                    MessageEnum::OrderCreatedError->value
                );
            }

            $redirect = true;
        }

        return [
            'options' => [
                'servicesList'    => $this->priceListService->getActualPriceList(),
                'orderCreateForm' => $form->createView(),
                'userEmail'       => $this->getUser()->getUserIdentifier(),
                'createOrderFormTitle'    => SelectorTextEnum::CreateOrderFormTitle->value,
                'labelServiceSelect'      => SelectorTextEnum::LabelServiceSelect->value,
                'spanServicePrice'        => SelectorTextEnum::SpanServicePrice->value,
                'labelEmailForSendReport' => SelectorTextEnum::LabelEmailForSendReport->value,
                'createOrderFormButton'   => SelectorTextEnum::CreateOrderFormButton->value,
                ],
            'redirect' => $redirect ?? false,
        ];
    }

    private function createOrderAsync(OrderCreateDTO $orderCreateDTO): bool
    {
        $orderBusDTO = $this->modelFactory->makeModel(
            OrderCreateBusDTO::class,
            $orderCreateDTO->email,
            $orderCreateDTO->priceListId,
            $this->getUser()->getUserIdentifier()
        );

        return $this->asyncBusService->handleOrderCreateByAsyncBus($orderBusDTO, $_ENV['APP_ENV']);
    }
}
