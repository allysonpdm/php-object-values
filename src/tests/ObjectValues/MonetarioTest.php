<?php

namespace Tests\Unit\ObjectValues;

#use Tests\TestCase;
use App\ObjectValues\Monetario;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class MonetarioTest extends TestCase
{
    public function test_monetario_value_is_valid()
    {
        $monetarioValue = new Monetario(10.50);
        $this->assertInstanceOf(Monetario::class, $monetarioValue);
    }

    public function test_monetario_value_is_invalid()
    {
        $this->expectException(InvalidArgumentException::class);
        $monetarioValue = new Monetario('invalid_monetario');
    }

    public function test_monetario_value_is_converted_to_string()
    {
        $monetarioValue = new Monetario(10.50);
        $this->assertEquals('10,50', (string) $monetarioValue);
    }

    public function test_monetario_value_with_different_decimals()
    {
        $monetarioValue = new Monetario(10.00, 4);
        $this->assertEquals('10,0000', (string) $monetarioValue);
    }

    public function test_monetario_value_with_currency_symbol()
    {
        $monetarioValue = new Monetario(10.50, 2);
        $monetarioValue->setSymbol('US$');
        $this->assertEquals('US$ 10,50', (string) $monetarioValue);
    }

    public function test_monetario_value_with_thousands_separator()
    {
        $monetarioValue = new Monetario(1000, 2);
        $monetarioValue->setThousandsSeparator('.');
        $this->assertEquals('1.000,00', (string) $monetarioValue);
    }

    public function test_monetario_value_with_decimal_separator()
    {
        $monetarioValue = new Monetario(10.5, 1);
        $monetarioValue->setDecimalSeparator(',');
        $this->assertEquals('10,5', (string) $monetarioValue);
    }

    public function test_monetario_value_with_invalid_separator()
    {
        $this->expectException(InvalidArgumentException::class);
        $monetarioValue = new Monetario(10.50, 2);
        $monetarioValue->setDecimalSeparator('invalid_separator');
    }

    public function test_monetario_value_with_negative_number()
    {
        $monetarioValue = new Monetario(-10.5, 1);
        $this->assertEquals('-10,5', (string) $monetarioValue);
    }

    public function test_monetario_value_with_zero_decimals()
    {
        $monetarioValue = new Monetario(10, 0);
        $this->assertEquals('10', (string) $monetarioValue);
    }

    public function test_monetario_wrong_value_with_zero_decimals()
    {
        //$this->expectException(InvalidArgumentException::class);
        $monetarioValue = new Monetario(10.5, 0);
        $this->assertEquals('11', (string) $monetarioValue);
    }

    public function test_monetario_value_with_empty_string()
    {
        $this->expectException(InvalidArgumentException::class);
        $monetarioValue = new Monetario('');
    }

    public function test_monetario_value_with_null()
    {
        $this->expectException(InvalidArgumentException::class);
        $monetarioValue = new Monetario(null);
    }
}
