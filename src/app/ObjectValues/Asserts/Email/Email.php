<?php

namespace App\ObjectValues\Asserts\Email;

use Symfony\Component\Validator\Constraint;

class Email extends Constraint
{
    public $message = 'O email "{{ value }}" não tem um MX válido.';

    public function __construct(
        public int $decimalPlaces = 2,
        array $options = null,
        array $groups = null,
        mixed $payload = null
    )
    {
        parent::__construct($options, $groups, $payload);
    }

}
