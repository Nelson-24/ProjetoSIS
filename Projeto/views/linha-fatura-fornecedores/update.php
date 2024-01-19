<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Linhasfaturasfornecedores $model */

$this->title = 'Editar Linha de Fatura Fornecedor: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Linha de Fatura Fornecedor', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="linhasfaturasfornecedores-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
