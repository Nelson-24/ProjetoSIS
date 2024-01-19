<?php

namespace backend\tests\functional;

use backend\models\Linhafatura;
use backend\tests\FunctionalTester;
use common\models\Artigos;
use common\models\Fatura;

class FaturasCest
{
    public function testCalculateTotalValue(FunctionalTester $I)
    {
        $fatura = new Fatura();
        $artigo = Artigos::findOne(22);
        // Crie linhas de fatura fictícias para a fatura
        $linha1 = new Linhafatura();
        $linha1->artigos_id =$artigo->id;
        $linha1->faturas_id = $fatura->id;
        $linha1->valor = 10;
        $linha1->quantidade = 2;

        $linha2 = new LinhaFatura();
        $linha2->valor = 20;
        $linha2->quantidade = 3;

        $fatura->link('linhasFatura', $linha1);
        $fatura->link('linhasFatura', $linha2);

        $totalCalculado = $fatura->calculateTotalValue();

        // Valor total esperado é 10 * 2 + 20 * 3 = 80
        $I->assertEquals(80, $totalCalculado);
    }

}