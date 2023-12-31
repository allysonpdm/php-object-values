<?php

namespace PhpObjectValues\App\ObjectValues;

use PhpObjectValues\App\Rules\DetranPlateRule;
use PhpObjectValues\App\ObjectValues\Contracts\{
    ObjectValue,
    Sanitizable
};
use PhpObjectValues\App\ObjectValues\Traits\Sanitized;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class PlacaAutomotiva extends ObjectValue implements Sanitizable
{
    use Sanitized;

    public function __construct(protected mixed $value)
    {
        $this->setRegex('[^A-Za-z0-9]');
    }

    protected function validate(): void
    {
        $validator = Validator::make(
            data: ['plate' => $this->value],
            rules: [
                'plate' => [
                    'string',
                    new DetranPlateRule()
                ]
            ]
        );

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }
    }

    public function __toString()
    {
        return strtoupper($this->value);
    }
}
