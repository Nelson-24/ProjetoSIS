<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Artigos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="carrinho">
    <div class="produto">
        <img src="imagem-do-produto.jpg" alt="Pavimento cerâmico Verna cinzento">
        <div class="descricao">
            <p>Pavimento cerâmico Verna cinzento 20.5x61.5 cm</p>
            <p>Ref 83020656</p>
        </div>
        <div class="quantidade">
            <button>-</button>
            <input type="number" value="1">
            <button>+</button>
        </div>
        <div class="preco">
            <p>11,34 €</p>
        </div>
    </div>
    <div class="resumo">
        <p>Subtotal: <span>11,34 €</span></p>
        <p>Recollha em Loja: <span>Gratuita</span></p>
        <p>Total: <span>11,34 €</span></p>
        <button>Validar o meu carrinho</button>
    </div>
</div>