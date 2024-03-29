<?php

use common\models\Linhascarrinhocompras;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Linhascarrinhocompras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="linhascarrinhocompras-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Linhascarrinhocompras', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'quantidade',
            'valor',
            'referencia',
            'artigos_id',
            //'carrinhocompras_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Linhascarrinhocompras $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
