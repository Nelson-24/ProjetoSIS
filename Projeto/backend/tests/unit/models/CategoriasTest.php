<?php

namespace backend\tests\unit\models;

use Codeception\Test\Unit;
use common\models\Categoria;

class CategoriasTest extends \Codeception\Test\Unit
{
    public function testRegrasValidacaoDescriao(){
        $categoria = new Categoria();

        $categoria->descricao = null;

        $categoria->validate();


        $this->assertTrue($categoria->hasErrors('descricao'));
    }



}