<?php

use yii\db\Migration;

/**
 * Class m240105_023046_init_rbac
 */
class m240105_023046_init_rbac extends Migration
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


        // Permissões para 'Artigos'
        $verArtigos = $auth->createPermission('verArtigos');
        $auth->add($verArtigos);

        $criarArtigos = $auth->createPermission('criarArtigos');
        $auth->add($criarArtigos);

        $editarArtigos = $auth->createPermission('editarArtigos');
        $auth->add($editarArtigos);

        $eliminarArtigos = $auth->createPermission('eliminarArtigos');
        $auth->add($eliminarArtigos);

// Permissões para 'Clientes'
        $verClientes = $auth->createPermission('verClientes');
        $auth->add($verClientes);

        $criarClientes = $auth->createPermission('criarClientes');
        $auth->add($criarClientes);

        $editarClientes = $auth->createPermission('editarClientes');
        $auth->add($editarClientes);

        $eliminarClientes = $auth->createPermission('eliminarClientes');
        $auth->add($eliminarClientes);

// Permissões para 'Categorias'
        $verCategorias = $auth->createPermission('verCategorias');
        $auth->add($verCategorias);

        $criarCategorias = $auth->createPermission('criarCategorias');
        $auth->add($criarCategorias);

        $editarCategorias = $auth->createPermission('editarCategorias');
        $auth->add($editarCategorias);

        $eliminarCategorias = $auth->createPermission('eliminarCategorias');
        $auth->add($eliminarCategorias);

// Permissões para 'Fornecedores'
        $verFornecedores = $auth->createPermission('verFornecedores');
        $auth->add($verFornecedores);

        $criarFornecedores = $auth->createPermission('criarFornecedores');
        $auth->add($criarFornecedores);

        $editarFornecedores = $auth->createPermission('editarFornecedores');
        $auth->add($editarFornecedores);

        $eliminarFornecedores = $auth->createPermission('eliminarFornecedores');
        $auth->add($eliminarFornecedores);

// Permissões para 'Faturas'
        $verFaturas = $auth->createPermission('verFaturas');
        $auth->add($verFaturas);

        $criarFaturas = $auth->createPermission('criarFaturas');
        $auth->add($criarFaturas);

        $editarFaturas = $auth->createPermission('editarFaturas');
        $auth->add($editarFaturas);

        $eliminarFaturas = $auth->createPermission('eliminarFaturas');
        $auth->add($eliminarFaturas);

// Permissões para 'FaturasFornecedores'
        $verFaturasFornecedores = $auth->createPermission('verFaturasFornecedores');
        $auth->add($verFaturasFornecedores);

        $criarFaturasFornecedores = $auth->createPermission('criarFaturasFornecedores');
        $auth->add($criarFaturasFornecedores);

        $editarFaturasFornecedores = $auth->createPermission('editarFaturasFornecedores');
        $auth->add($editarFaturasFornecedores);

        $eliminarFaturasFornecedores = $auth->createPermission('eliminarFaturasFornecedores');
        $auth->add($eliminarFaturasFornecedores);

// Permissões para 'Funcionarios'
        $verFuncionarios = $auth->createPermission('verFuncionarios');
        $auth->add($verFuncionarios);

        $criarFuncionarios = $auth->createPermission('criarFuncionarios');
        $auth->add($criarFuncionarios);

        $editarFuncionarios = $auth->createPermission('editarFuncionarios');
        $auth->add($editarFuncionarios);

        $eliminarFuncionarios = $auth->createPermission('eliminarFuncionarios');
        $auth->add($eliminarFuncionarios);

// Permissões para 'Ivas'
        $verIvas = $auth->createPermission('verIvas');
        $auth->add($verIvas);

        $criarIvas = $auth->createPermission('criarIvas');
        $auth->add($criarIvas);

        $editarIvas = $auth->createPermission('editarIvas');
        $auth->add($editarIvas);

        $eliminarIvas = $auth->createPermission('eliminarIvas');
        $auth->add($eliminarIvas);

// Permissões para 'Entregas'
        $verEntregas = $auth->createPermission('verEntregas');
        $auth->add($verEntregas);

        $criarEntregas = $auth->createPermission('criarEntregas');
        $auth->add($criarEntregas);

        $editarEntregas = $auth->createPermission('editarEntregas');
        $auth->add($editarEntregas);

        $eliminarEntregas = $auth->createPermission('eliminarEntregas');
        $auth->add($eliminarEntregas);

// Permissões para 'Fornecedores'
        $verFornecedores = $auth->createPermission('verFornecedores');
        $auth->add($verFornecedores);

        $criarFornecedores = $auth->createPermission('criarFornecedores');
        $auth->add($criarFornecedores);

        $editarFornecedores = $auth->createPermission('editarFornecedores');
        $auth->add($editarFornecedores);

        $eliminarFornecedores = $auth->createPermission('eliminarFornecedores');
        $auth->add($eliminarFornecedores);



//permissoes para entrar Frontend/Backend
        $loginBackend = $auth->createPermission('loginBackend');
        $auth->add($loginBackend);

        $loginFrontend = $auth->createPermission('loginFrontend');
        $auth->add($loginFrontend);









        //permissoes Cliente/////////////////////////////////////////////////////////////
        $auth->addChild($cliente,$criarClientes);
        $auth->addChild($cliente,$verClientes);
        $auth->addChild($cliente,$editarClientes);

        $auth->addChild($cliente,$loginFrontend);


        //permissoes func////////////////////////////////////////////////////////////////
        $auth->addChild($func,$loginBackend);

//Artigos
        $auth->addChild($func, $verArtigos);
        $auth->addChild($func, $editarArtigos);
        $auth->addChild($func, $eliminarArtigos);
        $auth->addChild($func, $criarArtigos);
//Forneceodres
        $auth->addChild($func, $verFornecedores);
        $auth->addChild($func, $criarFornecedores);
        $auth->addChild($func, $editarFornecedores);
        $auth->addChild($func, $eliminarFornecedores);
//Faturas
        $auth->addChild($func, $verFaturas);
        $auth->addChild($func, $criarFaturas);
        $auth->addChild($func, $editarFaturas);
        $auth->addChild($func, $eliminarFaturas);
//faturas fornecedores
        $auth->addChild($func, $verFaturasFornecedores);
        $auth->addChild($func, $criarFaturasFornecedores);
        $auth->addChild($func, $editarFaturasFornecedores);
        $auth->addChild($func, $eliminarFaturasFornecedores);
//entregas
        $auth->addChild($func, $verEntregas);
        $auth->addChild($func, $criarEntregas);
        $auth->addChild($func, $editarEntregas);
        $auth->addChild($func, $eliminarEntregas);
//Ivas
        $auth->addChild($func, $verIvas);
        $auth->addChild($func, $criarIvas);
        $auth->addChild($func, $editarIvas);
        $auth->addChild($func, $eliminarIvas);
//Clientes
        $auth->addChild($func, $verClientes);
        $auth->addChild($func, $criarClientes);
        $auth->addChild($func, $editarClientes);
        $auth->addChild($func, $eliminarClientes);
//Categorias
        $auth->addChild($func, $verCategorias);
        $auth->addChild($func, $criarCategorias);
        $auth->addChild($func, $editarCategorias);
        $auth->addChild($func, $eliminarCategorias);
//Fornecedores
        $auth->addChild($func, $verFornecedores);
        $auth->addChild($func, $criarFornecedores);
        $auth->addChild($func, $editarFornecedores);
        $auth->addChild($func, $eliminarFornecedores);











        //permissoes admin //////////////////////////////////////////////////////////////////////////////////
        $auth->addChild($admin,$loginBackend);
        $auth->addChild($admin , $func);
//Funcionarios
        $auth->addChild($admin, $verFuncionarios);
        $auth->addChild($admin, $criarFuncionarios);
        $auth->addChild($admin, $editarFuncionarios);
        $auth->addChild($admin, $eliminarFuncionarios);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240105_023046_init_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240105_023046_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}