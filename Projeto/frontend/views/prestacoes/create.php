<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \common\models\Prestacoes $model */

$this->title = 'Create Prestacoes';
$this->params['breadcrumbs'][] = ['label' => 'Prestacoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestacoes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
