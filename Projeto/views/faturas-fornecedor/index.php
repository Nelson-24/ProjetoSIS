<?php

use backend\models\Faturasfornecedores;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Faturas de Fornecedores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faturasfornecedores-index">


    <p>
        <?= Html::a('Selecionar Fornecedores', ['selecionar-fornecedores'], ['class' => 'btn btn-success']) ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'data',
            'valorTotal',
            'estado',
            'fornecedores_id',
            //'ivas_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Faturasfornecedores $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
