<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Entregas $model */

$this->title = 'Editar Entregas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Entregas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entregas-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
