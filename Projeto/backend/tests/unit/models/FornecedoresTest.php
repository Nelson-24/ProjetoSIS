<?php

namespace backend\tests\unit\models;

use backend\models\Faturasfornecedores;
use backend\models\Fornecedores;
use common\models\User;



class FornecedoresTest extends \Codeception\Test\Unit
{
    public function testRegraDesignacaoSocialObrigatoria()
    {

        $fornecedor = new Fornecedores();

        $fornecedor->designacaoSocial = null;

        $fornecedor->validate();

        $this->assertTrue($fornecedor->hasErrors('designacaoSocial'));

    }

    public function testUniqueNif()
    {
        $fornecedor = new Fornecedores();
        $fornecedor->nif = '123456789';
        $fornecedor->save();

        $fornecedor2 = new Fornecedores();
        $fornecedor2->nif = '123456789';
        $this->assertFalse($fornecedor2->validate(), 'NIF duplicado foi aceito');
    }

    public function testFaturasRelation()
    {
        $fornecedor = new Fornecedores();
        $fornecedor->designacaoSocial = 'Empresa Teste';
        $fornecedor->email = 'teste@teste.com';
        $fornecedor->nif = '987654321';
        $fornecedor->morada = 'Rua Teste, 123';
        $fornecedor->capitalSocial = '10000';

        $this->assertTrue($fornecedor->save(), 'Não foi possível guardar o fornecedor');

        $fatura = new Faturasfornecedores();
        // ... preencher os dados da fatura ...

        $fornecedor->link('faturasfornecedores', $fatura);
        $this->assertCount(1, $fornecedor->faturasfornecedores, 'A relação de faturas não foi feita corretamente');
    }



}