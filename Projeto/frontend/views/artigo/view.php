<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Artigos $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Artigos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="artigos-view">



   <!-- <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>-->    <div style="padding-left:100px"  class=""><img src="images/materiais/<?= $model->imagem ?>"></div>

    <div class="item-details">
        <h3><?= Html::encode($model->descricao) ?></h3>
        <p>Preço: <?= Html::encode($model->preco) ?> €</p>
        <p>Quantidade: <span id="quantidade">1</span>
            <button onclick="increment()" style="font-size: 20px; padding: 10px; background-color: green ">+</button>
            <button onclick="decrement()" style="font-size: 20px; padding: 10px; background-color: red">-</button>
            <?= Html::a('Adicionar ao Carrinho', ['artigo/adicionar-carrinho', 'id' => $model->id], ['class' => 'btn btn-primary adicionar-carrinho']) ?>
    </div></p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'referencia',
            'descricao',
            'preco',
            'stock',

        ],
    ]) ?>



    <script>
        let quantidade = 1;

        function increment() {
            quantidade++;
            document.getElementById('quantidade').innerText = quantidade;
        }

        function decrement() {
            if (quantidade > 1) {
                quantidade--;
                document.getElementById('quantidade').innerText = quantidade;
            }
        }

        // Adicionar ao Carrinho com a quantidade atualizada
        document.querySelector('.adicionar-carrinho').addEventListener('click', function(e) {
            e.preventDefault();
            let link = this.getAttribute('href');
            link += '&quantidade=' + quantidade;
            window.location.href = link;
        });
    </script>

    <!-- Botão para Voltar à Página Anterior -->
    <?= Html::a('Voltar', Yii::$app->request->referrer, ['class' => 'btn btn-primary']) ?>
</div>
