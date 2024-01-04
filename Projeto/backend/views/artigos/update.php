<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Artigo $model */

$this->title = 'Update Artigo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Artigo', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="artigos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>