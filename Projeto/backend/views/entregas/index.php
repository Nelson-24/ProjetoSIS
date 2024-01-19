<?php

use backend\models\Entregas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Entregas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entregas-index">


    <p>
        <?= Html::a('Adicionar Entregas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'status',
            'faturas_id',

            [
                'attribute' => 'nome',
                'label' => 'Nome',
                'value' => 'faturas.user.profile.nome',
            ],



            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Entregas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
