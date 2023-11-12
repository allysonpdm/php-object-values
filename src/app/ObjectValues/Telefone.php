<?php

namespace PhpObjectValues\App\ObjectValues;

use PhpObjectValues\App\ObjectValues\Contracts\{
    Maskable,
    Obfuscatable,
    ObjectValue,
    Sanitizable
};
use PhpObjectValues\App\ObjectValues\Traits\{
    Masked,
    Obfuscated,
    Sanitized
};
use InvalidArgumentException;
use Symfony\Component\Validator\Constraints\{
    NotBlank,
    Type
};
use Symfony\Component\Validator\Validation;

class Telefone extends ObjectValue implements Maskable, Sanitizable, Obfuscatable
{
    use Masked, Sanitized, Obfuscated;

    public function __construct(protected mixed $value)
    {
        parent::__construct($value);
        $this->setMask('(##) ####-####'); // Define a máscara para o número de telefone
        $this->setRegex('[^0-9]'); // Define o regex para remover caracteres não numéricos
        $this->value = $this->sanitized();
    }

    protected function validate(): void
    {
        $validator = Validation::createValidator();
        $violations = $validator->validate($this->value, [
            new NotBlank(),
            new Type('string'),
            // Aqui você pode adicionar regras de validação personalizadas para números de telefone, se necessário.
        ]);

        if (count($violations) > 0) {
            throw new InvalidArgumentException('O número de telefone é inválido.');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
