<?php

namespace App\DataFixtures;

use App\Entity\TransferCompany;
use App\Repository\TransferCompanyRepository;
use App\Service\Shipping\PriceCalculator\ConstantBag\TransferCompaniesNamesBag;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class AppFixtures extends Fixture
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $reflection = new \ReflectionClass(TransferCompaniesNamesBag::class);
        $constants = $reflection->getConstants();

        foreach ($constants as $name => $value) {
            $company = new TransferCompany();
            $company->setName($value);
            $this->entityManager->persist($company);
        }

        $this->entityManager->flush();
    }
}
