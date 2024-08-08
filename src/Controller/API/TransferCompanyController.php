<?php

namespace App\Controller\API;

use App\Controller\RestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TransferCompany\QueryService as TransferCompanyQueryService;
use App\Normalizer\Entity\Normalizer as EntityNormalizer;

#[Route(
    path: '/api/transfer-company',
)]
class TransferCompanyController extends RestController
{
    #[Route(
        path: '/list',
        name: 'api_transfer_company_list`',
        methods: 'GET',
    )]
    public function getListAction(
        TransferCompanyQueryService $queryService,
        EntityNormalizer $normalizer,
    ): JsonResponse {
        return $this->makeJsonResponse(
            array_map(
                function ($item) use ($normalizer) {
                    return $normalizer->normalize($item);
                },
                $queryService->getAll(),
            ),
        );
    }
}