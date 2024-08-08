<?php

namespace App\Service\TransferCompany;

use App\Entity\TransferCompany;
use App\Repository\TransferCompanyRepository;

class QueryService
{
    public function __construct(
        private TransferCompanyRepository $transferCompanyRepository,
    )
    {
    }

    public function getAll(): array
    {
        return $this->transferCompanyRepository->findAll();
    }

    public function getById(int $id): ?TransferCompany
    {
        return $this->transferCompanyRepository->findById($id);
    }
}