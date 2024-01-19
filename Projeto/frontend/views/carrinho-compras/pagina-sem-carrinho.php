<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Sem Carrinho';
?>
<div class="site-pagina-sem-carrinho">
    <h1>Você não possui nenhum carrinho ativo.</h1>
    <p>Seu carrinho está vazio no momento.</p>
    <p>Aqui está um link para adicionar produtos ao seu carrinho:</p>
    <p><?= Html::a('Explorar Produtos', ['/artigo/index']) ?></p>
</div>