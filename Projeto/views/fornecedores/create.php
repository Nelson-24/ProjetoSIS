<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Fornecedores $model */

$this->title = 'Adicionar Fornecedores';
$this->params['breadcrumbs'][] = ['label' => 'Fornecedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fornecedores-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
