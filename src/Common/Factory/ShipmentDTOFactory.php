<?php

namespace App\Common\Factory;

use App\Common\DTO\Shipment\ShipmentDTO;
use App\Common\DTO\Shipment\ShipmentDTOInterface;

class ShipmentDTOFactory
{
    public function create(array $data): ShipmentDTOInterface
    {
        return new ShipmentDTO(
            (float) $data['weight'] ?? null
        );
    }
}