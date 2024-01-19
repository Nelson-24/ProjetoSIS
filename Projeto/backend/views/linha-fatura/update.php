<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\LinhaFatura $model */

$this->title = 'Editar Linha de Fatura: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Linha de Faturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="linha-fatura-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
