<?php

namespace App\Controller\Api\PriceList\Create\v1;

use App\Domain\Factory\ModelFactory;
use App\Domain\Model\PriceListModel;
use App\Domain\Service\PriceListService;

class Handler
{
    public function __construct(
        /** @var ModelFactory<PriceListModel> */
        private readonly ModelFactory $modelFactory,
        private readonly PriceListService $priceListService,
    ) {
    }


    public function create(InputPriceListDTO $inputPriceListDTO): OutputPriceListDTO
    {
        $priceListModel = $this->modelFactory->makeModel(
            PriceListModel::class,
            null,
            $inputPriceListDTO->title,
            $inputPriceListDTO->price,
            $inputPriceListDTO->validFrom,
            $inputPriceListDTO->expiresFrom,
        );

        $priceListModel = $this->priceListService->create($priceListModel);

        return new OutputPriceListDTO(
            $priceListModel->id,
            $priceListModel->title,
            $priceListModel->price,
            $inputPriceListDTO->validFrom,
            $inputPriceListDTO->expiresFrom,
        );
    }

}
