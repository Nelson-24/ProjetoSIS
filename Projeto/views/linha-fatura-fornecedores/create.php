<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Linhasfaturasfornecedores $model */

$this->title = 'Adicionar Linhasfaturasfornecedores';
$this->params['breadcrumbs'][] = ['label' => 'Linhasfaturasfornecedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="linhasfaturasfornecedores-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
