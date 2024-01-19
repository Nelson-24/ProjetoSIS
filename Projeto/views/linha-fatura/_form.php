
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\LinhaFatura $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="linha-fatura-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>
    <?= $form->field($model, 'valor')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'referencia')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'artigos_id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'faturas_id')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
