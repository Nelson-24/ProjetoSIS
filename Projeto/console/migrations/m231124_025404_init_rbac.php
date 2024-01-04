<?php

use yii\db\Migration;

/**
 * Class m231124_025404_init_rbac
 */
class m231124_025404_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $admin = $auth->createRole ('admin');
        $auth->add($admin);
        $func = $auth->createRole('funcionario');
        $auth->add($func);
        $cliente = $auth->createRole('cliente');
        $auth->add($cliente);


        $criarFaturasCliente = $auth->createPermission('criarFaturasCliente');
        $auth->add($criarFaturasCliente);

        $criarFaturasForn = $auth->createPermission('criarFaturasForn');
        $auth->add($criarFaturasForn);



        $despacharEncomendas = $auth->createPermission('despacharEncomendas');
        $auth->add($despacharEncomendas);

        $verArtigos = $auth->createPermission('verArtigos');
        $auth->add($verArtigos);

        $criarArtigos = $auth->createPermission('criarArtigos');
        $auth->add($criarArtigos);

        $editarArtigos = $auth->createPermission('editarArtigos');
        $auth->add($editarArtigos);

        $eliminarArtigos = $auth->createPermission('eliminarArtigos');
        $auth->add($eliminarArtigos);

        $verClientes = $auth->createPermission('verClientes');
        $auth->add($verClientes);

        $criarClientes = $auth->createPermission('criarClientes');
        $auth->add($criarClientes);

        $editarClientes = $auth->createPermission('editarClientes');
        $auth->add($editarClientes);

        $eliminarClientes = $auth->createPermission('eliminarClientes');
        $auth->add($eliminarClientes);

        $verFornecedores = $auth->createPermission('verFornecedores');
        $auth->add($verFornecedores);

        $criarFornecedores = $auth->createPermission('criarFornecedores');
        $auth->add($criarFornecedores);

        $editarFornecedores = $auth->createPermission('editarFornecedores');
        $auth->add($editarFornecedores);

        $eliminarFornecedores = $auth->createPermission('eliminarFornecedores');
        $auth->add($eliminarFornecedores);

        $verUser = $auth->createPermission('verUSer');
        $auth->add($verUser);

        $criarUser = $auth->createPermission('criarUSer');
        $auth->add($criarUser);

        $editarUser = $auth->createPermission('editarUser');
        $auth->add($editarUser);

        $eliminarUser = $auth->createPermission('eliminarUser');
        $auth->add($eliminarUser);





        $loginBackend = $auth->createPermission('loginBackend');
        $auth->add($loginBackend);


        //permissoes Cliente
        $auth->addChild($cliente,$criarClientes);

        //permissoes func
        $auth->addChild($func,$loginBackend);

        //permissoes admin
        $auth->addChild($admin,$loginBackend);



        $auth->assign($admin, 1);
        $auth->assign($func, 2);
        $auth->assign($cliente, 3);






        $auth->addChild($admin , $func);
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231124_025404_init_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231124_025404_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
