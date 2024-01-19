<?php
namespace backend\tests;

use common\models\Prestacoes;



class PrestacoesTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {

        $prestacao = new Prestacoes();


        $prestacao->valor = 'srting';
        $this->assertFalse($prestacao->validate(['valor']));

        $prestacao->id = 'string';
        $this->assertFalse($prestacao->validate(['id']));

        $prestacao->data = null;
        $this->assertFalse($prestacao->validate(['valor']));

        $prestacao->user_id = null;
        $this->assertFalse($prestacao->validate(['user_id']));



    }


        public function Createtest(){

            $prestacao1 = new Prestacoes();
            $prestacao1->id = '100';
            $prestacao1->valor = '100';
            $prestacao1->data = '2024-02-02';
            $prestacao1->user_id = '1';
            $prestacao1->save();
            $this->assertEquals('100',$prestacao1->getPrimaryKey());
            $this->tester->seeInDatabase('prestacoes', ['id' => '100']);
        }

        public function editTest(){


        $model = Prestacoes::findOne(1);

        $model->valor = '10';
        $model->data = '2024-08-04';
        $model->user_id = '2';
        $model->save();

        $prestacao = Prestacoes::findOne(['user_id' =>  $model->user_id]);

        $prestacao->valor = '200';
        $prestacao->data = '2004-08-04';
        $prestacao->save();

        $this->assertEquals('200', $prestacao->valor);
        $this->assertEquals('2004-08-04', $prestacao->data);





        }

}