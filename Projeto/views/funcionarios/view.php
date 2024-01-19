<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">


    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            [
                'label' => 'Nome',
                'value' => $model->profile !== null ? $model->profile->nome : 'N/A',
            ],
            [
                'label' => 'NIF',
                'value' => $model->profile !== null ? $model->profile->nif : 'N/A',
            ],
            [
                'label' => 'Morada',
                'value' => $model->profile !== null ? $model->profile->morada : 'N/A',
            ],
            [
                'label' => 'Contacto',
                'value' => $model->profile !== null ? $model->profile->contacto : 'N/A',
            ],

        ]
    ]) ?>
</div>
