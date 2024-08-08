<?php

namespace App\Service\Shipping\PriceCalculator;

use App\Entity\TransferCompany;
use App\Service\Shipping\PriceCalculator\ConstantBag\ExceptionMessagesBag;
use App\Service\Shipping\PriceCalculator\Exception\TransferCompanyIsNotSupported;

class CalculatorService
{
    private function throwNotSupportedException(TransferCompany $transferCompany): void
    {
        throw new TransferCompanyIsNotSupported(
            sprintf(
                ExceptionMessagesBag::TRANSFER_COMPANY_IS_NOT_SUPPORTED,
                $transferCompany->getName())
        );
    }
}