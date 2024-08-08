<?php

namespace App\Service\Shipping\PriceCalculator\Processor\Handlers;

use App\Common\Processor\HandlerInterface;
use App\Service\Shipping\PriceCalculator\ConstantBag\TransferCompaniesNamesBag;
use App\Service\Shipping\PriceCalculator\Processor\DTO\DataInterface;

class PackGroupHandler implements HandlerInterface
{
    public function handle(mixed &$data): void
    {
        $weight = $data->getShipmentDTO()->getWeight();

        if ($weight > 0 && $weight <= 10) {
            $data->setPayload(['price' => 20]);
        }elseif ($weight > 10) {
            $data->setPayload(['price' => 100]);
        }
    }

    public function supports(mixed $data): bool
    {
        return $data instanceof DataInterface &&
            $data->getTransferCompany()->getName() === TransferCompaniesNamesBag::PACK_GROUP;
    }
}