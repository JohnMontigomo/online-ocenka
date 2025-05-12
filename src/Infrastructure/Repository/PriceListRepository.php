<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\PriceList;
use App\Domain\Repository\PriceListRepositoryInterface;
use DateTime;

/**
 * @extends AbstractRepository<PriceList>
 */
class PriceListRepository extends AbstractRepository implements PriceListRepositoryInterface
{
    public function create(PriceList $priceList): int
    {
        return $this->store($priceList);
    }

    public function getPriceListById(int $id): PriceList
    {
        return  $this->entityManager->getRepository(PriceList::class)->findOneBy(['id' => $id]);
    }

    /**
     * @return PriceList[]
     */
    public function getActualPriceList(): array
    {
        $query = $this->entityManager->createQuery(
            "SELECT PriceList
            FROM App\Domain\Entity\PriceList PriceList
            WHERE PriceList.validFrom <= :now
            AND PriceList.expiresFrom >= :now
            ORDER BY PriceList.id ASC"
        );
        $query->setParameter('now', new DateTime());

        return $query->getResult();
    }
}
