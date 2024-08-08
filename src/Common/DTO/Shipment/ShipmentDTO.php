<?php

namespace App\Common\DTO\Shipment;

use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Validator\Constraints as Assert;

readonly class ShipmentDTO implements ShipmentDTOInterface
{
    #[Assert\NotBlank]
    #[Assert\Type('numeric')]
    #[Assert\Range(
        notInRangeMessage: "The value weight must be {{ min }} or greater.",
        min: 0.1
    )]
    private mixed $weight;

    public function __construct(
        mixed $weight,
    ) {
        $this->weight = $weight;
    }

    public function getWeight(): mixed
    {
        return $this->weight;
    }
}