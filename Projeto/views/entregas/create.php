<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Entregas $model */

$this->title = 'Adicionar Entregas';
$this->params['breadcrumbs'][] = ['label' => 'Entregas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entregas-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
