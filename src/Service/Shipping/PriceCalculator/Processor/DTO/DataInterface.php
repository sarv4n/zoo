<?php

namespace App\Service\Shipping\PriceCalculator\Processor\DTO;

use App\Common\DTO\Shipment\ShipmentDTOInterface;
use App\Entity\TransferCompany;

interface DataInterface
{
    public function getShipmentDTO(): ShipmentDTOInterface;
    public function setShipmentDTO(ShipmentDTOInterface $shipmentDTO): void;
    public function getTransferCompany(): TransferCompany;
    public function setTransferCompany(TransferCompany $transferCompany): void;
    public function getPayload(): array;
    public function setPayload(array $payload): void;
}