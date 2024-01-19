<?php

use common\models\Categoria;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Artigos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="artigos-form">

    <?php $form = ActiveForm::begin(['options' =>['enctype' => 'multipart/form-data']] ); ?>

    <?= $form->field($model, 'referencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preco')->textInput() ?>

    <?= $form->field($model, 'stock')->textInput() ?>


    <?= $form->field($model, 'categoria_id')->dropDownList(
        ArrayHelper::map(Categoria::find()->all(), 'id', 'descricao'),
        ['prompt' => 'Selecione a categoria']
    ) ?>

    <?= $form->field($model, 'ivas_id')->dropDownList(
        ArrayHelper::map(\common\models\Ivas::find()->all(), 'id', 'descricao'),
        ['prompt' => 'Selecione o Iva']
    ) ?>


    <?= $form->field($model, 'imagem')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
