<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Faturasfornecedores $model */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->title = 'Editar Faturas de Fornecedores: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Faturas de Fornecedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="faturasfornecedores-update">


    <?= $this->render('_form', [
        'model' => $model,
        'dataProvider' =>$dataProvider,
    ]) ?>

</div>
