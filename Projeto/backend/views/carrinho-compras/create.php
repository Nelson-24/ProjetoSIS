<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Linhascarrinhocompras $model */

$this->title = 'Create Linhascarrinhocompras';
$this->params['breadcrumbs'][] = ['label' => 'Linhascarrinhocompras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="linhascarrinhocompras-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
