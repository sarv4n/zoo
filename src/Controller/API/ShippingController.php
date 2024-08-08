<?php

namespace App\Controller\API;

use App\Common\Exception\ValidationException;
use App\Controller\RestController;
use App\Service\Common\Validator\ValidatorService;
use App\Service\Shipping\PriceCalculator\ConstantBag\ExceptionMessagesBag;
use App\Service\Shipping\PriceCalculator\Factory\CalculationRequestDTOFactory;
use App\Service\Shipping\PriceCalculator\Processor\CalculatorProcessor;
use App\Service\Shipping\PriceCalculator\Processor\Factory\DataFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    path: '/api/shipping',
)]
class ShippingController extends RestController
{
    #[Route(
        path: '/get-price',
        name: 'api_get_shipping_price`',
        methods: 'GET',
    )]
    public function getShippingPriceAction(
        Request $request,
        CalculationRequestDTOFactory $requestDTOFactory,
        ValidatorService $validatorService,
        DataFactory $dataFactory,
        CalculatorProcessor $processor,
    ): JsonResponse {
        $requestData = $request->query->all();

        $requestDTO = $requestDTOFactory->create($requestData);

        $validatorService->validateWithThrowsException($requestDTO);

        $data = $dataFactory->create($requestDTO);
        $processor->process($data);

        if (!isset($data->getPayload()['price'])) {
            return $this->makeJsonErrorResponse(
                sprintf(
                    ExceptionMessagesBag::TRANSFER_COMPANY_IS_NOT_SUPPORTED,
                    $data->getTransferCompany()->getName(),
                ),
            );
        }

        return $this->makeJsonResponse($data->getPayload()['price']);
    }
}