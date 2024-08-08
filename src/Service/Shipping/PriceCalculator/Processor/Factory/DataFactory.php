<?php

namespace App\Service\Shipping\PriceCalculator\Processor\Factory;

use App\Service\Shipping\PriceCalculator\ConstantBag\ExceptionMessagesBag;
use App\Service\Shipping\PriceCalculator\DTO\CalculationRequestDTOInterface;
use App\Service\Shipping\PriceCalculator\Exception\TransferCompanyIsNotFound;
use App\Service\Shipping\PriceCalculator\Processor\DTO\Data;
use App\Service\Shipping\PriceCalculator\Processor\DTO\DataInterface;
use App\Service\TransferCompany\QueryService as TransferCompanyQueryService;

class DataFactory
{
    public function __construct(
        private readonly TransferCompanyQueryService $transferCompanyQueryService,
    )
    {
    }

    public function create(CalculationRequestDTOInterface $dto): DataInterface
    {
        $transferCompany = $this->transferCompanyQueryService->getById($dto->getTransferCompanyId());

        return new Data(
            $dto->getShipmentDTO(),
            $transferCompany,
        );
    }
}