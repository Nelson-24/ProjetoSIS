<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
/** @var common\models\User $model */


// Supondo que $profile contenha os detalhes do perfil a serem exibidos

?>


<br>


    <h1>Perfil do Cliente</h1>
<br>
<br>
<?php
echo DetailView::widget([
'model' => $model,
'attributes' => [
'id',
    'username',
    [
        'label' => 'Nome',
        'value' => $model->profile !== null ? $model->profile->nome : 'N/A',
    ],
    'email',
    [
        'label' => 'Morada',
        'value' => $model->profile !== null ? $model->profile->morada : 'N/A',
    ],
    [
        'label' => 'Contacto',
        'value' => $model->profile !== null ? $model->profile->contacto : 'N/A',
    ],
    [
        'label' => 'Nif',
        'value' => $model->profile !== null ? $model->profile->nif : 'N/A',
    ],
    [
        'label' => 'Faturas',
        'format' => 'raw',
        'value' => function () use ($model) {
            return Html::a('Ver Faturas', ['fatura/index', 'id' => $model->id], ['class' => 'btn btn-primary']);
        },
    ],



],
]);

?>