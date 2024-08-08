<?php

namespace App\Service\Shipping\PriceCalculator\Processor\DTO;

use App\Common\DTO\Shipment\ShipmentDTOInterface;
use App\Entity\TransferCompany;

class Data implements DataInterface
{
    public function __construct(
        private ShipmentDTOInterface $shipmentDTO,
        private TransferCompany $transferCompany,
        private array $payload = [],
    )
    {
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }

    public function getShipmentDTO(): ShipmentDTOInterface
    {
        return $this->shipmentDTO;
    }

    public function setShipmentDTO(ShipmentDTOInterface $shipmentDTO): void
    {
        $this->shipmentDTO = $shipmentDTO;
    }

    public function getTransferCompany(): TransferCompany
    {
        return $this->transferCompany;
    }

    public function setTransferCompany(TransferCompany $transferCompany): void
    {
        $this->transferCompany = $transferCompany;
    }
}