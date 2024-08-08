<?php

namespace App\Service\Shipping\PriceCalculator\DTO;

use App\Common\DTO\Shipment\ShipmentDTOInterface;
use App\Common\Http\RequestDTOInterface;

interface CalculationRequestDTOInterface extends RequestDTOInterface
{
    public function getTransferCompanyId(): mixed;

    public function getShipmentDTO(): ShipmentDTOInterface;
}