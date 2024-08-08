<?php

namespace App\Repository;

use App\Entity\TransferCompany;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TransferCompany>
 */
class TransferCompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TransferCompany::class);
    }

    public function findById(int $id): ?TransferCompany
    {
        return $this->findOneBy(['id' => $id]);
    }
}
