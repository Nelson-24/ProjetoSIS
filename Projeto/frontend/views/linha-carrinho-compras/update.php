<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Linhascarrinhocompras $model */

$this->title = 'Update Linhascarrinhocompras: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Linhascarrinhocompras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="linhascarrinhocompras-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
