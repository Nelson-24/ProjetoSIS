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


    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'referencia',
            'descricao',
            'preco',
            'stock',
            'categoria_id',
            [
                    'attribute' => 'Imagem',
                'value' => 'http://localhost/ProjetoPSI_/frontend/web/images/materiais/' . $model->imagem,
                'format' => ['image', ['width' => '100' , 'height' => '100']],
            ]
        ],
    ]) ?>

</div>
