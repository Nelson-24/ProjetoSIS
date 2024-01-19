<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Faturasfornecedores $model */

$this->title = 'Adicionar Faturas de Fornecedores';
$this->params['breadcrumbs'][] = ['label' => 'Faturas de Fornecedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faturasfornecedores-create">


    <?= $this->render('_formCreate', [
        'model' => $model,
    ]) ?>

</div>
