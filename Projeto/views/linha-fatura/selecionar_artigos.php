<?php

use common\models\User;
use backend\models\Linhafatura;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var \backend\models\Fatura $faturas */

$this->title = 'Selecionar Artigos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artigos-selecionar">



    <p>


    </p>




    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'referencia',
            'descricao',
            'preco',
            'stock',
            [
                'class' => ActionColumn::className(),
                'template' => '{create-fatura}',
                'buttons' => [
                    'create-fatura' => function ($url, $model){
                        return Html::a(
                            'Selecionar',
                            ['linha-fatura/create', 'artigos_id' => $model->id],
                            ['class' => 'btn btn-success']
                        );
                    },
                ],
            ],
        ],
    ]); ?>


</div>
