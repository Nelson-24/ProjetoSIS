<?php

use common\models\Prestacoes;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Prestacoes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestacoes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'valor',
            'data',
            'user_id',

        ],
    ]); ?>


</div>
