<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \common\models\CarrinhoCompras $model */
/** @var \common\models\Linhascarrinhocompras $linha */

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
                <!-- Informações de cada item do carrinho -->
                <?php
                $imagemSrc = 'http://localhost/ProjetoPSI_/frontend/web/images/materiais/' . $linhaCarrinho->artigos->imagem;
                ?>
                <img src="<?= $imagemSrc ?>" alt="Imagem do Artigo" width="100" height="150">
                <div class="item-details">
                    <h3><?= $linhaCarrinho->artigos->descricao ?></h3>
                    <p>Preço: $<?= $linhaCarrinho->valor ?></p>
                    <p>Quantidade: <?= $linhaCarrinho->quantidade ?></p>
                    <?= Html::a('Eliminar Artigo', ['linha-carrinho-compras/delete', 'id' => $linhaCarrinho->id], [
                        'class' => 'remove-item',
                        'data' => [

                            'method' => 'post', // Utilize 'post' para ações de exclusão
                        ],
                    ]) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="cart-total">

        <div class="info-right">
            <th><?php echo 'Sub Total: ' . $model->valor. '<br>'; ?> </th>
            <th><?php echo 'Iva: ' . $model->valorIva. '<br>'; ?> </th>
            <th><?php echo 'Total:  ' . $model->valorTotal. '<br>'; ?> </th>

            <?= Html::a('Pagamento Pronto', ['carrinho-compras/finalizar-carrinho', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>




        </div>
    </div>
</div>
</body>
</html>
