<?php

namespace Tests\Unit\ObjectValues;

#use Tests\TestCase;
use App\ObjectValues\Decimal;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class DecimalTest extends TestCase
{
    public function test_decimal_value_is_valid()
    {
        $decimalValue = new Decimal(10.50);
        $this->assertInstanceOf(Decimal::class, $decimalValue);
    }

    public function test_decimal_value_is_invalid()
    {
        $this->expectException(InvalidArgumentException::class);
        $decimalValue = new Decimal('invalid_decimal');
    }

    public function test_decimal_value_is_converted_to_string()
    {
        $decimalValue = new Decimal(10.50);
        $this->assertEquals('10.50', (string) $decimalValue);
    }

    public function test_decimal_value_with_different_decimals()
    {
        $decimalValue = new Decimal(10.50, 3);
        $this->assertEquals('10.500', (string) $decimalValue);
    }

    public function test_decimal_value_with_thousands_separator()
    {
        $decimalValue = new Decimal(1000, 2);
        $decimalValue->setThousandsSeparator(',');
        $this->assertEquals('1,000.00', (string) $decimalValue);
    }

    public function test_decimal_value_with_decimal_separator()
    {
        $decimalValue = new Decimal(10.5, 1);
        $decimalValue->setDecimalSeparator(',');
        $this->assertEquals('10,5', (string) $decimalValue);
    }

    public function test_decimal_value_with_invalid_separator()
    {
        $this->expectException(InvalidArgumentException::class);
        $decimalValue = new Decimal(10.50, 2);
        $decimalValue->setDecimalSeparator('invalid_separator');
    }

    public function test_decimal_value_with_negative_number()
    {
        $decimalValue = new Decimal(-10.5, 1);
        $this->assertEquals('-10.5', (string) $decimalValue);
    }

    public function test_decimal_value_with_zero_decimals()
    {
        $decimalValue = new Decimal(10, 0);
        $this->assertEquals('10', (string) $decimalValue);
    }

    public function test_decimal_wrong_value_with_zero_decimals()
    {
        $decimalValue = new Decimal(10.5, 0);
        $this->assertEquals('11', (string) $decimalValue);
    }

    public function test_decimal_value_with_empty_string()
    {
        $this->expectException(InvalidArgumentException::class);
        $decimalValue = new Decimal('');
    }

    public function test_decimal_value_with_null()
    {
        $this->expectException(InvalidArgumentException::class);
        $decimalValue = new Decimal(null);
    }
}
