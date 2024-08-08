<?php

namespace App\Service\Shipping\PriceCalculator\Factory;

use App\Common\Factory\ShipmentDTOFactory;
use App\Service\Common\Validator\ValidatorService;
use App\Service\Shipping\PriceCalculator\DTO\CalculationRequestDTO;

class CalculationRequestDTOFactory
{
    public function __construct(
        private ShipmentDTOFactory $shipmentDTOFactory,
        private ValidatorService $validatorService,
    )
    {
    }

    public function create(array $data): CalculationRequestDTO
    {
        $shipmentDTO = $this->shipmentDTOFactory->create($data);
        $this->validatorService->validateWithThrowsException($shipmentDTO);

        return new CalculationRequestDTO(
            $data['transferCompanyId'] ?? null,
            $shipmentDTO,
        );
    }
}