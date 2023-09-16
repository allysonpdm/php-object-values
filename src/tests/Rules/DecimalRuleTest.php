<?php

namespace Tests\Unit\Rules;

use PHPUnit\Framework\TestCase;
use App\Rules\DecimalRule;
use TypeError;

class DecimalRuleTest extends TestCase
{
    public function test_valid_decimal_value()
    {
        $result = DecimalRule::isValid(10.50);

        $this->assertTrue($result);
    }

    public function test_invalid_decimal_value()
    {
        $result = DecimalRule::isValid('abc');
        $this->assertFalse($result);
    }

    public function test_decimal_as_string()
    {
        $result = DecimalRule::isValid('10.555');

        $this->assertFalse($result);
    }

    public function test_decimal_invalid()
    {
        $result = DecimalRule::isValid('10.55b');

        $this->assertFalse($result);
    }

    public function test_empty_decimal_value()
    {
        $result = DecimalRule::isValid('');
        $this->assertFalse($result);
    }
}
