<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\userFixture;
use common\models\Artigos;
use common\models\User;
use yii\helpers\Url;

/**
 * Class ProdutosCest
 */

class ProdutosCest
{

    /**
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */


    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ],
        ];
    }
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->fillField('LoginForm[username]', 'admin');
        $I->seeInField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->seeInField('LoginForm[password]', 'admin123');
        $I->click('#login-form button[type=submit]');

    }



    public function criarProduto(FunctionalTester $I)
    {

        $I->see('Starter Page');

        $I->click('#artigos-menu-item');

        $I->click(['id' => 'artigos-create']);
        $I->amOnPage('artigos/index');

        $I->click('#artigos-create');

        $I->fillField('Artigos[referencia]', '222222');
        $I->fillField('Artigos[descricao]', 'Palete');
        $I->fillField('Artigos[preco]', '20');
        $I->fillField('Artigos[stock]', '0');
        $I->selectOption('Artigos[categoria_id]', 'Blocos');
        $I->selectOption('Artigos[iva_id]', 'Iva normal');
        $I->fillField('Artigos[imagem]', 'imagem.png');


        $I->click('Save');

        $I->seeRecord(Artigos::className(), ['descricao'=>'Palete']);
    }

   public function editarProduto(FunctionalTester $I)
    {
        $I->click('Criação dos Produtos');

        $I->click('#criar-produto');

        $I->fillField('Produtos[nome]', 'Bolo de Caramelo');
        $I->fillField('Produtos[descricao]', 'fewbufewuyfytewv');
        $I->fillField('Produtos[preco]', '20');
        $I->fillField('Produtos[obs]', 'ewfwefewfewf');
        $I->selectOption('Produtos[categoria_produto_id]', 'Bolo');
        $I->selectOption('Produtos[iva_id]', '23');

        $I->click('Save');

        $I->click('Update');

        $I->fillField('Produtos[nome]', 'Bolo de Laranja');
        $I->fillField('Produtos[descricao]', 'fewbwehbfhewbf');
        $I->fillField('Produtos[preco]', '10');

        $I->click('Save');

        $I->seeRecord(Artigos::className(), ['nome'=>'Bolo de Laranja', 'descricao'=>'fewbwehbfhewbf', 'preco'=>'10']);
    }
}
