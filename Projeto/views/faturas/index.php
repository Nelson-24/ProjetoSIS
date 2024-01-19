<?php

use common\models\Fatura;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Fatura';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faturas-index">

    <p>

        <?= Html::a('Selecionar Cliente', ['selecionar-clientes'], ['class' => 'btn btn-success']) ?>


    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'data',
            'valorTotal',
            'estado',
            'opcaoEntrega',
            //'users_id',
            //'ivas_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Fatura $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
