<?php

use backend\models\Linhasfaturasfornecedores;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Linhas de Faturas de Fornecedores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="linhasfaturasfornecedores-index">


    <p>
        <?= Html::a('Adicionar Linha de Fatura Fornecedor', ['create'], ['class' => 'btn btn-success']) ?>
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
            //'faturasfornecedores_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Linhasfaturasfornecedores $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
