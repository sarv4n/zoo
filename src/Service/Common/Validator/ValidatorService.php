<?php

declare(strict_types=1);

namespace App\Service\Common\Validator;

use App\Service\Common\Validator\ValidatorServiceInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Common\Exception\ValidationException;

class ValidatorService implements ValidatorServiceInterface
{
    public function __construct(private readonly ValidatorInterface $systemValidator)
    {
    }

    public function validate($value, $constraint = null, $groups = null): ConstraintViolationListInterface
    {
        return $this->systemValidator->validate($value, $constraint, $groups);
    }

    public function validateWithThrowsException($value, $constraint = null, $groups = null): bool
    {
        $errors = $this->validate($value, $constraint, $groups);
        $errorList = $this->generateErrorList($errors);

        if ($errorList) {
            throw new ValidationException($errorList);
        }

        return true;
    }

    public function generateErrorList(ConstraintViolationListInterface $errors): array
    {
        foreach ($errors as $error) {
            $toReturn[$error->getPropertyPath()][] = $error->getMessage();
        }

        return $toReturn ?? [];
    }
}