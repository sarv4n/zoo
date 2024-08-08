<?php

namespace App\Validator\Entity;

use App\Entity\EntityInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ExistingEntityIdConstraintValidator extends ConstraintValidator
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!$constraint instanceof ExistingEntityIdConstraint) {
            throw new UnexpectedTypeException($constraint, ExistingEntityIdConstraint::class);
        }

        $entityReflectionClass = new \ReflectionClass($constraint->entity);

        if (!$entityReflectionClass->implementsInterface(EntityInterface::class)) {
            throw new UnexpectedTypeException($constraint->entity, EntityInterface::class);
        }

        $repository = $this->entityManager->getRepository($constraint->entity);

        $record = $repository->findOneBy(['id' => $value]);

        if ($record == null) {
            $this->context->buildViolation($constraint->message)
                          ->setParameter('{{ entity }}', $constraint->entity)
                          ->setParameter('{{ value }}', $value)
                          ->addViolation()
            ;
        }

    }
}
