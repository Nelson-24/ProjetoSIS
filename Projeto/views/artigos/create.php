<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Artigos $model */

$this->title = 'Adicionar Artigos';
$this->params['breadcrumbs'][] = ['label' => 'Artigos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artigos-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
