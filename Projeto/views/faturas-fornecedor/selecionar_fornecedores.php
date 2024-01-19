<?php

use backend\models\Fornecedores;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Selecionar Fornecedores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faturas-selecionar">



    <p>


    </p>




    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
           'designacaoSocial',
            'email',
            [
                'class' => ActionColumn::className(),
                'template' => '{create-fatura}',
                'buttons' => [
                    'create-fatura' => function ($url, $model) {
                        return Html::a('Criar Fatura', ['faturas-fornecedor/create', 'fornecedores_id' => $model->id], ['class' => 'btn btn-success']
                        );
                    },
                ],

            ]

        ]

    ]); ?>


</div>
