<?php

namespace App\ObjectValues\Asserts\Email;

use App\Rules\{
    PhoneValidationRule,
};
use InvalidArgumentException;
use Symfony\Component\Validator\{
    Constraint,
    ConstraintValidator
};

class TelefoneValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if(
            !is_string($value) ||
            empty($value)
        ){
            throw new InvalidArgumentException('Um telefone deve ser informado');
        }

        if (!PhoneValidationRule::isValid($value, $constraint->decimalPlaces)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}