<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Fatura $model */




$this->title = 'Adicionar Fatura';
$this->params['breadcrumbs'][] = ['label' => 'Fatura', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faturas-create">


    <?= $this->render('formCreate', [
        'model' => $model,


    ]) ?>

</div>
