<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \common\models\CarrinhoCompras $model */
/** @var yii\widgets\ActiveForm $form */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="css/css.css">
</head>
<body>
<div class="cart-container">
    <h1>Meu Carrinho de Compras</h1>
    <br>
    <br>
    <br>


    <div class="cart-items">
        <?php foreach ($linhasCarrinho as $linhaCarrinho): ?>
            <div class="cart-item">

                <?php
                $imagemSrc = 'http://localhost/ProjetoPSI_/frontend/web/images/materiais/' . $linhaCarrinho->artigos->imagem;
                ?>
                <img src="<?= $imagemSrc ?>" alt="Imagem do Artigo" width="100" height="150">
                <div class="item-details">
                    <h3><?= $linhaCarrinho->artigos->descricao ?></h3>
                    <p>Preço: $<?= $linhaCarrinho->valor ?></p>
                    <p>Quantidade: <?= $linhaCarrinho->quantidade ?></p>
                    <button class="remove-item">Remover</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="cart-total">

        <div class="info-right">
            <span>Total: <?= $carrinho->valor ?></span>
            <span>IVA: <?= $linhaCarrinho->valorIva ?></span>
            <span>Valor Total:<?= $linhaCarrinho->valorTotal ?> </span>
            <button class="checkout-btn">Finalizar Compra</button>
        </div>
    </div>
</div>
</body>
</html>