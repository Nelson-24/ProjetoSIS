<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\LinhaFatura $model */



$this->title = 'Adicionar Linha de Fatura';
$this->params['breadcrumbs'][] = ['label' => 'Linha de Faturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="linha-fatura-create">


    <?= $this->render('_form', [
        'model' => $model,


    ]) ?>

</div>
