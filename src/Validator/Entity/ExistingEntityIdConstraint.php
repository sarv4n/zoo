<?php

namespace App\Validator\Entity;

use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ExistingEntityIdConstraint extends Constraint
{
    public string $message = '{{ entity }} with ID value "{{ value }}" do not exists.';

    #[HasNamedArguments]
    public function __construct(
        public string $entity,
        ?array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct([], $groups, $payload);
    }
}
