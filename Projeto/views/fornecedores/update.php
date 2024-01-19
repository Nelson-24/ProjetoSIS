<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Fornecedores $model */

$this->title = 'Editar Fornecedor: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fornecedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fornecedores-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
