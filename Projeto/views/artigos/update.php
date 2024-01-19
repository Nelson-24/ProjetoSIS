<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Artigos $model */

$this->title = 'Editar Artigos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Artigos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="artigos-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
