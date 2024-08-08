<?php

namespace App\Service\Shipping\PriceCalculator\Processor\Handlers;

use App\Common\Processor\HandlerInterface;
use App\Service\Shipping\PriceCalculator\ConstantBag\TransferCompaniesNamesBag;
use App\Service\Shipping\PriceCalculator\Processor\DTO\DataInterface;

class TransCompanyHandler implements HandlerInterface
{
    public function handle(mixed &$data): void
    {
        $weight = $data->getShipmentDTO()->getWeight();

        if ($weight > 0) {
            $data->setPayload(['price' => $weight]);
        }
    }

    public function supports(mixed $data): bool
    {
        return $data instanceof DataInterface
               && $data->getTransferCompany()->getName() === TransferCompaniesNamesBag::TRANS_COMPANY;
    }
}