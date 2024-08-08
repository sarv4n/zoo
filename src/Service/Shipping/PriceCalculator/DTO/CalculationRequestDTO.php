<?php

namespace App\Service\Shipping\PriceCalculator\DTO;

use App\Common\DTO\Shipment\ShipmentDTOInterface;
use App\Entity\TransferCompany;
use App\Validator\Entity as EntityAssert;
use Symfony\Component\Validator\Constraints as Assert;

readonly class CalculationRequestDTO implements CalculationRequestDTOInterface
{
    #[Assert\NotBlank]
    #[Assert\Range(
        notInRangeMessage: "The value ID must be {{ min }} or greater.",
        min: 0
    )]
    #[EntityAssert\ExistingEntityIdConstraint(entity: TransferCompany::class)]
    private mixed $transferCompanyId;
    private ShipmentDTOInterface $shipmentDTO;

    public function __construct(
        mixed $transferCompanyId,
        ShipmentDTOInterface $shipmentDTO,
    )
    {
        $this->transferCompanyId = $transferCompanyId;
        $this->shipmentDTO = $shipmentDTO;
    }

    public function getShipmentDTO(): ShipmentDTOInterface
    {
        return $this->shipmentDTO;
    }

    public function getTransferCompanyId(): mixed
    {
        return $this->transferCompanyId;
    }
}