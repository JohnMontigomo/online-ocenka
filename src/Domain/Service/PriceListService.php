<?php

namespace App\Domain\Service;

use App\Domain\Entity\PriceList;
use App\Domain\Factory\ModelFactory;
use App\Domain\Model\PriceListModel;
use App\Domain\Repository\PriceListRepositoryInterface;

class PriceListService
{
    public function __construct(
        /** @var ModelFactory<PriceListModel> */
        private readonly ModelFactory $modelFactory,
        private readonly PriceListRepositoryInterface $priceListRepository,
    ) {
    }

    public function create(PriceListModel $model): PriceListModel
    {
        $priceList = new PriceList();
        $priceList->setTitle($model->title);
        $priceList->setPrice($model->price);
        $priceList->setValidFrom($model->validFrom);
        $priceList->setExpiresFrom($model->expiresFrom);

        $this->priceListRepository->create($priceList);

        return $this->modelFactory->makeModel(
            PriceListModel::class,
            $priceList->getId(),
            $priceList->getTitle(),
            $priceList->getPrice(),
            $priceList->getValidFrom()->format('Y-m-d H:i:s'),
            $priceList->getExpiresFrom()->format('Y-m-d H:i:s'),
        );
    }

    /**$priceList
     * @return PriceList[]
     */
    public function getActualPriceList(): array
    {
        $priceListArray =  $this->priceListRepository->getActualPriceList();
        $priceListModelArray = [];

        foreach ($priceListArray as $priceList) {
            $priceListModelArray[] = $this->modelFactory->makeModel(
                PriceListModel::class,
                $priceList->getId(),
                $priceList->getTitle(),
                $priceList->getPrice(),
                null,
                null
            );
        }

        return $priceListModelArray;
    }

    public function getPriceListById(int $id): PriceList
    {
        return $this->priceListRepository->getPriceListById($id);
    }

    public function deleteAll(): void
    {
        $this->priceListRepository->deleteAll(PriceList::class);
    }
}
