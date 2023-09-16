<?php

namespace Tests\Unit\Rules;

use PHPUnit\Framework\TestCase;
use App\Rules\DetranPlateRule;

class DetranPlateRuleTest extends TestCase
{
    public function test_valid_detran_plate()
    {
        $detranPlateRule = new DetranPlateRule();

        // Placa no formato ABC-1234
        $this->assertTrue($detranPlateRule->passes('detran_plate', 'ABC-1234'));

        // Placa no formato ABC1D23
        $this->assertTrue($detranPlateRule->passes('detran_plate', 'ABC1D23'));

        // Placa no formato ABC-1D23
        $this->assertTrue($detranPlateRule->passes('detran_plate', 'ABC-1D23'));

        // Placa no formato ABC1D23 (formato Mercosul)
        $this->assertTrue($detranPlateRule->passes('detran_plate', 'ABC1D23'));

        // Placa no formato ABC1D2-3 (formato Mercosul)
        $this->assertTrue($detranPlateRule->passes('detran_plate', 'ABC1D2-3'));

        // Placa no formato ABCD1E2 (formato Mercosul)
        $this->assertTrue($detranPlateRule->passes('detran_plate', 'ABCD1E2'));
    }

    public function test_invalid_detran_plate()
    {
        $detranPlateRule = new DetranPlateRule();

        // Placa com formato inválido
        $this->assertFalse($detranPlateRule->passes('detran_plate', 'ABCD123'));

        // Placa com formato inválido
        $this->assertFalse($detranPlateRule->passes('detran_plate', 'ABC-123'));

        // Placa com formato inválido
        $this->assertFalse($detranPlateRule->passes('detran_plate', 'ABCD1D23'));

        // Placa com formato inválido
        $this->assertFalse($detranPlateRule->passes('detran_plate', 'ABC-D23'));

        // Placa com formato inválido
        $this->assertFalse($detranPlateRule->passes('detran_plate', 'ABCD-123'));

        // Placa com formato inválido
        $this->assertFalse($detranPlateRule->passes('detran_plate', 'ABCD-1D23'));

        // Placa com formato inválido
        $this->assertFalse($detranPlateRule->passes('detran_plate', 'abc-1234'));

        // Placa com formato inválido (formato Mercosul)
        $this->assertFalse($detranPlateRule->passes('detran_plate', 'ABCD-123'));

        // Placa com formato inválido (formato Mercosul)
        $this->assertFalse($detranPlateRule->passes('detran_plate', 'ABC1D2'));

        // Placa com formato inválido (formato Mercosul)
        $this->assertFalse($detranPlateRule->passes('detran_plate', 'ABCD12E'));
    }


    public function test_error_message()
    {
        $detranPlateRule = new DetranPlateRule();
        $message = $detranPlateRule->message();

        $this->assertEquals('A placa informada não é válida.', $message);
    }

    public function test_empty_detran_plate()
    {
        $detranPlateRule = new DetranPlateRule();
        $result = $detranPlateRule->passes('detran_plate', '');

        $this->assertFalse($result);
    }
}
